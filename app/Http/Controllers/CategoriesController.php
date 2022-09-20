<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Validation\ValidationException;

use App\Http\Traits\HasAuthorization;

class CategoriesController extends Controller
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
        $categories = Categories::with("recipes")->get()->paginate(10);
        return $categories;
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

        $categories = new Categories();
        $categories->name = $validated["name"];
        $categories->save();

        return response()->json(
            [
                "message" => "Addition success."
            ],
            201
        );
    }

    public function show($id)
    {
        if (!$this->isAuthorized("userOrAdmin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        $obj_category = Categories::find($id);

        return $obj_category->load("recipes");
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

        try {
            $validated = $request->validate([
                "name" => "required|string|min:5|max:255"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ]);
        }

        $categories = Categories::findOrFail($id);
        $categories->name = $validated["name"];
        $categories->save();

        return response()->json(
            [
                "message" => "Modification success."
            ]
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->isAuthorized("admin", user::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        Categories::destroy($id);

        return response()->json([
            "message" => "Deletion success."
        ]);
    }
}