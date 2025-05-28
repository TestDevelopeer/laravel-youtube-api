<?php

namespace App\Traits;

trait WithRelationships
{
    public function scopeWithRelationships($query, array|string $relationshipsRequest)
    {
        $validRelationships = collect($relationshipsRequest)
            ->map(fn(string $relationship): array => explode('.', $relationship))
            ->filter(function (array $relationships) {
                return collect($relationships)->reduce(function ($model, $relationship) {
                    if ($model && method_exists($model, $relationship) && in_array($relationship, $model::$relationships, true)) {
                        return $model->$relationship()->getRelated();
                    }

                    return null;
                }, new static);
            })
            ->map(fn(array $relationships): string => implode('.', $relationships))
            ->all();

        return $query->with($validRelationships);
    }
}
