<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj_tag = Tags::with("recipes")->get();
        return $obj_tag;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj_tag = Tags::findOrfail($id);

        return $obj_tag;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj_tag = Tags::create([
            "name"=> $request->name
        ]);
        $obj_tag->save();

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
        $obj_tag= Tags::findOrFail($request->id);
        //$tags->recipe_id = $request->recipe_id;
        $obj_tag->name = $request->name;
        $obj_tag->save();

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
        $obj_tag = Tags::findOrfail($request->id);

        $obj_tag->delete();

        return response()->json([
            "message" => "Deletion success."
        ]);
    }
}