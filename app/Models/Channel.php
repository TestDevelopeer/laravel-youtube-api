<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
