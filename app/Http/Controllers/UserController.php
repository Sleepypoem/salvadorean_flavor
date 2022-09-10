<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|min:5|max:255",
            "password" => "required|string|min:8",
            "email" => "required|email|string"
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->image = $request->image;

        $user->save();

        return response()->json([
            "message" => "User added successfully."
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $obj_user = User::find($user);

        return $obj_user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            "name" => "required|string|min:5|max:255",
            "password" => "required|min:5",
            "image" => "required|min:1"
        ]);

        $obj_user = User::find($user)->first();
        $obj_user->name = $request->name;
        $obj_user->email = $request->email;
        $obj_user->password = $request->password;
        $obj_user->image = $request->image;

        $obj_user->save();

        return response()->json([
            "message" => "User modified successfully."
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->user_id);
        return response()->json([
            "message" => "User deleted successfully."
        ], 201);
    }
}