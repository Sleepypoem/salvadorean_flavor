<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipes;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipes::all();
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
        $recipes= new Recipes();
        $recipes->recipe_id = $request->recipe_id;
        $recipes->admin_id = $request->admin_id;
        $recipes->name= $request->name;
        $recipes->ingredients=$request->ingredients;
        $recipes->steps=$request->steps;
        $recipes->category= $request->category;
        $recipes->image=$request->image;

        $recipes-> save();
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
        $recipes = Recipes::findOrFail($request->id);
        $recipes->recipe_id = $request->recipe_id;
        $recipes->admin_id = $request->admin_id;
        $recipes->name= $request->name;
        $recipes->ingredients=$request->ingredients;
        $recipes->steps=$request->steps;
        $recipes->category= $request->category;
        $recipes->image=$request->image;
        $recipes-> save();

    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Recipes::destroy($request->id);
        return $recipes;
    }
}
