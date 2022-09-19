<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredients;
use App\Models\Image;
use App\Models\User;
use App\Models\Tags;
use App\Models\Categories;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredients',
        'steps',
        'category_id',
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

    public function category()
    {
        return $this->belongsTo(Categories::class, "category_id", "category_id");
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, "recipes_tags", "recipe_id", "tag_id");
    }
}