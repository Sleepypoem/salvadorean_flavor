<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients_recipes', function (Blueprint $table) {
            $table->bigInteger("recipe_id")->unsigned();
            $table->bigInteger("ingredient_id")->unsigned();

            $table->foreign("recipe_id")->references("recipe_id")->on("recipes")->onDelete("cascade");
            $table->foreign("ingredient_id")->references("ingredient_id")->on("ingredients")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients_recipes');
    }
};