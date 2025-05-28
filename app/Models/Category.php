<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends RelationshipsModel
{
    use HasFactory;

    protected static array $relationships = ['videos'];

    public function videos(): BelongsToMany
    {
        return $this->belongsToMany(Video::class);
    }

    public function scopeSearch($query, ?string $name)
    {
        return $query->where('name', 'like', "%$name%");
    }
}
