<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    protected $PrimaryKey = "category_id";

    public function recipes()
    {
        return $this->hasMany(Recipe::class, "category_id");
    }
}