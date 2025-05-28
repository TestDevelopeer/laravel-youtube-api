<?php

namespace App\Traits;

trait WithRelationships
{
    public function scopeWithRelationships($query, array|string $relationshipsRequest)
    {
        $validRelationships = collect($relationshipsRequest)
            ->map(fn(string $relationship): array => explode('.', $relationship))
            ->filter(fn(array $relationships): bool => (new static)->hasRelationships($relationships))
            ->map(fn(array $relationships): string => implode('.', $relationships))
            ->all();

        return $query->with($validRelationships);
    }

    public function hasRelationships(array $relationships): bool
    {
        return (bool)collect($relationships)
            ->reduce(fn($model, $relationship) => optional($model)->hasOneRelationship($relationship), $this);
    }

    public function hasOneRelationship(string $relationship)
    {
        return $this->isValidRelationShip($relationship) ? $this->$relationship()->getRelated() : null;
    }

    public function isValidRelationShip(string $relationship): bool
    {
        return method_exists($this, $relationship) && in_array($relationship, static::$relationships, true);
    }
}
