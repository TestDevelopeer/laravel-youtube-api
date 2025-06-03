<?php

namespace App\Models;

use App\Enums\Period;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends RelationshipsModel
{
    use HasFactory;

    protected static array $relationships = ['channel', 'categories', 'playlists'];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function scopeFromPeriod($query, ?Period $period)
    {
        return $period
            ? $query->where('created_at', '>=', $period->date())
            : $query;
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where(function ($query) use ($text) {
            $query->where('title', 'like', "%$text%")
                ->orWhere('description', 'like', "%$text%");
        });
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


}
