<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    public function associateParentComment(): void
    {
        if ($this->replies()->exists()) {
            return;
        }

        $this->parent()->associate($this->findRandomToMakeParent())->save();
    }

    public function replies(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class);
    }

    private function findRandomToMakeParent()
    {
        return $this->video
            ->comments()
            ->doesntHave('parent')
            ->where('id', '<>', $this->id)
            ->inRandomOrder()
            ->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
