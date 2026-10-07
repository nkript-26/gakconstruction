<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'image', 'icon', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}