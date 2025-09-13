<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenUsage extends Model
{
    protected $fillable = ['user_id','action','tokens','meta'];

    protected $casts = [
        'meta' => 'array',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }
}
