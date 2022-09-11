<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::with("ingredients")->get();
        return $recipes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingredients = $request->ingredients;

        $recipes = new Recipe();
        $recipes->name = $request->name;
        $recipes->ingredients()->attach($ingredients);
        $recipes->steps = $request->steps;
        $recipes->category = $request->category;
        $recipes->image = $request->image;

        $recipes->save();

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
    public function update(Request $request, $id)
    {
        $ingredients = $request->ingredients;

        $recipes = Recipe::findOrFail($id);
        $recipes->name = $request->name;
        $recipes->steps = $request->steps;
        $recipes->category = $request->category;
        $recipes->image = $request->image;
        $recipes->ingredients()->sync($ingredients);
        $recipes->save();

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
        Recipe::destroy($request->id);
        return response()->json([
            "message" => "Deletion success."
        ]);
    }
}