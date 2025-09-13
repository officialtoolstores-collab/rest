<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TokenUsage extends Model
{
    protected $fillable = ['user_id', 'action', 'tokens'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
