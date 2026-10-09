<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = ["project_name", "location", "description", "image", "completion_date"];
    protected $casts = ["completion_date" => "date"];
}