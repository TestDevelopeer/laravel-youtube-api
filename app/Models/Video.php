<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{
    use HasFactory;

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }
}
