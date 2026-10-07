<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name', 'location', 'description', 'image',
        'category', 'completion_date', 'is_featured'
    ];

    protected $casts = [
        'completion_date' => 'date',
        'is_featured' => 'boolean',
    ];
}