<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\User;

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

        $categories = new Categories();
        $categories->category_id = $request->category_id;
        $categories->name = $request->name;
        $categories->save();
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

        $categories = Categories::findOrFail($id);
        $categories->category_id = $request->category_id;
        $categories->name = $request->name;
        $categories->save();
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
    }
}