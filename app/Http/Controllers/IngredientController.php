<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Http\Traits\HasAuthorization;
use Illuminate\Validation\ValidationException;

use App\Http\Traits\ImageManager;
use App\Models\User;

class IngredientController extends Controller
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

        $obj_ingredient = Ingredients::with("recipes", "image")->get();
        return $obj_ingredient;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->isAuthorized("userOrAdmin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }
        $obj_ingredient = Ingredients::findOrfail($id);

        return $obj_ingredient->load("image", "recipes.image");
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
            $validated = $request->validate([
                "name" => "required|string|min:5|max:255"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ]);
        }

        $obj_ingredient = Ingredients::create([
            "name" => $validated["name"]
        ]);

        $obj_ingredient->image()->create([
            "title" => $obj_ingredient->name . "_image",
            "image" => $this->saveImage("ingredients/", $request->image)
        ]);

        $obj_ingredient->save();

        return response()->json([
            "message" => "Addition success."
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$this->isAuthorized("admin", $request->user())) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        try {
            $validated = $request->validate([
                "name" => "required|string|min:5|max:255"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ]);
        }
        $obj_ingredient = Ingredients::findOrFail($request->id);
        if ($request->image != null) {

            $obj_image = $validated["name"];

            $this->deleteImage($obj_image, "ingredients");

            $obj_ingredient->image()->create([
                "title" => $obj_ingredient->name . "_image",
                "image" => $this->saveImage("ingredients/", $request->image)
            ]);
        }
        $obj_ingredient->name = $request->name;
        $obj_ingredient->save();

        return response()->json([
            "message" => "Modification success."
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *@param  \Illuminate\Http\Request  $request
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

        $obj_ingredient = Ingredients::findOrFail($request->id);

        $obj_image = $obj_ingredient->image;

        $this->deleteImage($obj_image, "ingredients");

        $obj_ingredient->delete();

        return response()->json([
            "message" => "Deletion success."
        ]);
    }
}