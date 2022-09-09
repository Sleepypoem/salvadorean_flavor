<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateFields = [
            "name" => "required|string|min:5|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8"
        ];

        $validated = $request->validate($validateFields);

        $admin = Administrator::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
            "image" => $request->image
        ]);

        $token = $admin->createToken("auth_token")->plainTextToken;

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

        $admin = Administrator::where(["email" => $request->email])->firstOrFail();

        $token = $admin->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Login success.",
            "access_token" => $token,
            "token_type" => "Bearer"
        ]);
    }

    public function userInfo(Request $request)
    {
        return $request->admin();
    }
}