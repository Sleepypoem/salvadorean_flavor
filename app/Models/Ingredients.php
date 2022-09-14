<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Image;

class Ingredients extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $primaryKey = "ingredient_id";


    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, "ingredients_recipe", "recipe_id", "ingredient_id");
    }

    public function image()
    {
        return $this->morphOne(Image::class, "imageable");
    }
}