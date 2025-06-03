<?php

namespace App\Traits;

trait WithRelationships
{
    public function scopeWithRelationships($query, $relationshipsRequest)
    {
        return $query->with($this->validRelationships($relationshipsRequest));
    }

    public function validRelationships($relationships)
    {
        return collect($relationships)
            ->map(fn(string $relationship): array => explode('.', $relationship))
            ->filter(fn(array $relationships): bool => (new static)->hasRelationships($relationships))
            ->map(fn(array $relationships): string => implode('.', $relationships))
            ->all();
    }

    public function hasRelationships($relationships): bool
    {
        return (bool)collect($relationships)
            ->reduce(fn($model, $relationship) => optional($model)->hasOneRelationship($relationship), $this);
    }

    public function hasOneRelationship($relationship)
    {
        return $this->isValidRelationShip($relationship) ? $this->$relationship()->getRelated() : null;
    }

    public function isValidRelationShip($relationship): bool
    {
        return method_exists($this, $relationship) && in_array($relationship, static::$relationships, true);
    }

    public function loadRelationships($relationshipsRequest)
    {
        return $this->load($this->validRelationships($relationshipsRequest));
    }
}
