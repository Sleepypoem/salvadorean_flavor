<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasAuthorization;
use Illuminate\Http\Request;
use App\Models\User;

//spatie

use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use HasAuthorization;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->isAuthorized("admin", $request->user())) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        $obj_roles = Role::with("permissions")->get()->paginate(10);

        return $obj_roles;
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
                "name" => "required",
                "guard_name" => "required",
                "permission" => "required"
            ]);
        } catch (\Illuminate\Validation\ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ], 422);
        }

        $obj_role = Role::create([
            "name" => $validated["name"],
            "permission" => $validated["permission"],
            "guard_name" => $validated["guard_name"]
        ]);
        $obj_role->syncPermissions($request->permission);

        return response()->json(
            [
                "message" => "Addition success."
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->isAuthorized("admin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }

        $obj_role = Role::findOrFail($id);

        return $obj_role->load("permissions");
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
                "name" => "required",
                "guard_name" => "required",
                "permission" => "required"
            ]);
        } catch (\Illuminate\Validation\ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ], 422);
        }

        $obj_role = Role::findOrFail($id);
        $obj_role->name = $validated["name"];
        $obj_role->guard_name = $validated["guard_name"];
        $obj_role->save();

        $obj_role->syncPermissions($validated["permission"]);

        return response()->json(
            [
                "message" => "Edit success."
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
        if (!$this->isAuthorized("admin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }
        Role::destroy($id);

        return response()->json(
            [
                "message" => "Deletion success."
            ]
        );
    }
}