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
        Schema::create('recipes_tags', function (Blueprint $table) {
            $table->unsignedBigInteger("tag_id");
            $table->unsignedBigInteger("recipe_id");
            $table->timestamps();

            $table->foreign("recipe_id")->references("recipe_id")->on("recipes");
            $table->foreign("tag_id")->references("tag_id")->on("tags");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes_tags');
    }
};