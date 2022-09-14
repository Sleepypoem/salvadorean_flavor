<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Traits\ImageManager;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    use ImageManager;

    public function index()
    {
        $users = User::with("roles", "image")->get()->paginate(5);

        return $users;
    }

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
            "password" => Hash::make($validated["password"])
        ]);

        $obj_user->image()->create([
            "title" => $obj_user->name . "_image",
            "image" => $this->saveImage("users/", $request->image)
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
        $obj_image = $obj_user->image;

        $obj_user->name = $request->name;
        $obj_user->email = $request->email;
        $obj_user->password = Hash::make($request->password);

        $this->deleteImage($obj_image, "users");

        $obj_user->image()->create([
            "title" => $obj_user->name . "_image",
            "image" => $this->saveImage("users/", $request->image)
        ]);

        $obj_user->save();

        $obj_user->syncRoles($request->role);

        return response()->json([
            "message" => "User modified successfully"
        ], 201);
    }

    public function userInfo(Request $request)
    {
        $obj_user = User::find($request->id);

        return $obj_user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj_user = User::find($id);
        $obj_image = $obj_user->image;
        $this->deleteImage($obj_image, "users");

        $obj_user->delete();
        return response()->json([
            "message" => "User deleted successfully."
        ], 201);
    }
}