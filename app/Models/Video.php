<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
}
