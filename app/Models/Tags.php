<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;


    protected $fillable = [
        'name'
    ];

    protected $primaryKey = 'tag_id';

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, "recipes_tags", "recipe_id", "tag_id");
    }
}