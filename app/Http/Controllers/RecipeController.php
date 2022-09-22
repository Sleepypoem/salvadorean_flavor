<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;

use App\Http\Traits\ImageManager;
use App\Models\User;
use App\Http\Traits\HasAuthorization;
use Illuminate\Validation\ValidationException;


class RecipeController extends Controller
{

    use ImageManager, HasAuthorization;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->isAuthorized("userOrAdmin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }
        $obj_recipes = Recipe::with("ingredients", "image", "category", "tags")->get()->paginate(15);
        return $obj_recipes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!$this->isAuthorized("admin", $request->user())) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        try {
            $request->validate([
                "name" => "required",
                "steps" => "required",
                "category_id" => "required"
            ]);
        } catch (\Illuminate\Validation\ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ], 422);
        }


        $ingredients = $request->ingredients;

        $obj_recipe = Recipe::create([
            "name" => $request->name,
            "steps" => $request->steps,
        ]);

        $obj_recipe->category_id = $request->category_id;
        $obj_recipe->save();

        $obj_recipe->ingredients()->attach($ingredients);

        if ($request->image !== null) {
            $obj_recipe->image()->create([
                "title" => $obj_recipe->name . "_image",
                "image" => $this->saveImage("recipes/", $request->image)
            ]);
        }

        return response()->json([
            "message" => "Addition success."
        ], 201);
    }

    public function show($id)
    {
        if (!$this->isAuthorized("userOrAdmin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        $obj_recipe = Recipe::findOrFail($id);

        return $obj_recipe->load("ingredients", "image", "category", "tags");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->isAuthorized("admin", $request->user())) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        $ingredients = $request->ingredients;

        $obj_recipe = Recipe::findOrFail($id);
        $obj_image = $obj_recipe->image;

        $this->deleteImage($obj_image, "recipes");

        $obj_recipe->image()->create([
            "title" => $obj_recipe->name . "_image",
            "image" => $this->saveImage("recipes/", $request->image)
        ]);

        try {
            $request->validate([
                "name" => "required",
                "steps" => "required",
                "category_id" => "required"
            ]);
        } catch (\Illuminate\Validation\ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ], 422);
        }

        $obj_recipe->name = $request->name;
        $obj_recipe->steps = $request->steps;
        $obj_recipe->category_id = $request->category_id;
        $obj_recipe->ingredients()->sync($ingredients);
        $obj_recipe->save();

        return response()->json([
            "message" => "Modification success."
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$this->isAuthorized("admin", $request->user())) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        $obj_recipe = Recipe::findOrFail($request->id);
        $obj_image = $obj_recipe->image;

        $this->deleteImage($obj_image, "recipes");

        $obj_recipe->delete();
        
        return response()->json([
            "message" => "Deletion success."
        ]);
    }
}