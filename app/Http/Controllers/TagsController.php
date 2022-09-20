<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;
use App\Http\Traits\HasAuthorization;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class TagsController extends Controller
{

    use HasAuthorization;
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

        return $obj_tag->load("recipes");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->isAuthorized("userOrAdmin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        try {
            $validated = $request->validate([
                "name" => "required"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ], 422);
        }

        Tags::create([
            "name" => $validated["name"]
        ]);

        return response()->json([
            "message" => "Addition success."
        ]);
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
        if (!$this->isAuthorized("userOrAdmin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }
        try {
            $validated = $request->validate([
                "name" => "required",
                "guard_name" => "required",
                "permission" => "required"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ], 422);
        }
        $obj_tag = Tags::findOrFail($request->id);
        $obj_tag->name = $validated["name"];
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
        if (!$this->isAuthorized("userOrAdmin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }
        $obj_tag = Tags::findOrfail($request->id);

        $obj_tag->delete();

        return response()->json([
            "message" => "Deletion success."
        ]);
    }
}