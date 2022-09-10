<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'recipe_id',
        'admin_id',
        'name',
        'ingredients',
        'steps',
        'category',
        'image'
    ];
    use HasFactory;
}
