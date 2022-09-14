<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredients;
use App\Models\Image;
use App\Models\User;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredients',
        'steps',
        'category',
    ];

    protected $primaryKey = "recipe_id";

    public function ingredients()
    {
        return $this->belongsToMany(Ingredients::class, "ingredients_recipe", "recipe_id", "ingredient_id");
    }

    public function image()
    {
        return $this->morphOne(Image::class, "imageable");
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, "favorites", "user_id", "recipe_id");
    }
}