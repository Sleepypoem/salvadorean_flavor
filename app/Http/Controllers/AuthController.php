<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

use App\Http\Traits\ImageManager;

class AuthController extends Controller
{

    use ImageManager;

    public function index()
    {
        $users = User::with("roles", "image", "favorites")->get()->paginate(5);

        return $users;
    }

    public function createUser(Request $request, array $validated,  $role = "user")
    {

        $obj_user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"])
        ]);

        $obj_user->image()->create([
            "title" => $obj_user->name . "_image",
            "image" => $this->saveImage("users/", $request->image)
        ]);

        $obj_user->syncRoles($role);

        return $obj_user;
    }

    public function isAuthorized($ability, $user)
    {
        $response = Gate::inspect($ability, $user);

        return $response->allowed();
    }

    public function registerAdmin(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => "required|string|min:5|max:255",
                "email" => "required|string|email|max:255|unique:users",
                "password" => "required|string|min:8"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ]);
        }

        if (!$this->isAuthorized("registerAdmin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ]);
        }

        $obj_user = $this->createUser($request, $validated, "admin");

        $token = $obj_user->createToken("auth_token", ['registerAdmin'])->plainTextToken;

        return response()->json([
            "message" => "Register success.",
            "access_token" => $token,
            "token_type" => "Bearer"
        ], 201);
    }

    public function registerUser(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => "required|string|min:5|max:255",
                "email" => "required|string|email|max:255|unique:users",
                "password" => "required|string|min:8"
            ]);
        } catch (\Illuminate\Validation\ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ]);
        }

        $obj_user = $this->createUser($request, $validated);

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
            "token_type" => "Bearer",
            "debug" => $obj_user->can("create")
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
        try {
            $request->validate([
                "name" => "required|string|min:5|max:255",
                "email" => "required|string|email|max:255|unique:users"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ]);
        }

        $obj_user = User::find($user)->first();
        $obj_image = $obj_user->image;
        $favorites = $request->favorites;

        $obj_user->name = $request->name;
        $obj_user->email = $request->email;
        $obj_user->password = Hash::make($request->password);

        if ($request->image != $obj_user->image->image) {
            $this->deleteImage($obj_image, "users");

            $obj_user->image()->create([
                "title" => $obj_user->name . "_image",
                "image" => $this->saveImage("users/", $request->image)
            ]);
        }

        $obj_user->save();

        $obj_user->syncRoles($request->role);
        $obj_user->favorites()->sync($favorites);

        return response()->json([
            "message" => "User modified successfully"
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
    public function destroy($id)
    {
        $obj_user = User::find($id);

        if (!$this->isAuthorized("delete", $obj_user)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ]);
        }

        $obj_image = $obj_user->image;
        $this->deleteImage($obj_image, "users");

        $obj_user->delete();
        return response()->json([
            "message" => "User deleted successfully."
        ], 201);
    }
}