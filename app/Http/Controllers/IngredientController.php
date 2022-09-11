<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredients;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredients::all();
        return $ingredients;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingredients = new Ingredients();

        $ingredients->recipe_id = $request->recipe_id;
        $ingredients->name = $request->name;
        $ingredients->image = $request->image;

        $ingredients->save();

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
        $ingredients = Ingredients::findOrFail($request->$id);
        
        $ingredients->recipe_id = $request->recipe_id;
        $ingredients->name = $request->name;
        $ingredients->image = $request->image;

        $ingredients->save();

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
        Igredients::destroy($request->id);
        return response()->json([
            "message" => "Deletion success."
        ]);
    }
}
