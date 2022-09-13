<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

//spatie

use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateFields = [
            "name" => "required|string|min:5|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8",
            "role" => "required"
        ];

        $validated = $request->validate($validateFields);

        $obj_user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
            "image" => $request->image
        ]);

        $obj_user->syncRoles($validated["role"]);

        $token = $obj_user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Register success.",
            "access_token" => $token,
            "token_type" => "Bearer"
        ], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "message" => "Invalid login info."
            ], 401);
        };

        $obj_user = User::where(["email" => $request->email])->firstOrFail();

        $token = $obj_user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Login success.",
            "access_token" => $token,
            "token_type" => "Bearer"
        ]);
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

    public function userInfo(Request $request)
    {
        return $request->user();
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