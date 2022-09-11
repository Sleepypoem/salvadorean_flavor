<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredients;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredients',
        'steps',
        'category',
        'image'
    ];

    protected $primaryKey = "recipe_id";

    public function ingredients()
    {
        return $this->belongsToMany(Ingredients::class);
    }
}