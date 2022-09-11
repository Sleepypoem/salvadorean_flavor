<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;

class Ingredients extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];

    protected $primaryKey = "ingredient_id";


    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}