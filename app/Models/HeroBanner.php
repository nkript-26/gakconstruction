<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}