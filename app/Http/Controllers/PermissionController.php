<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasAuthorization;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class PermissionController extends Controller
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

        $obj_permissions = Permission::paginate(10);

        return $obj_permissions;
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
                "name" => "required|string|min:5|max:255",
                "guard_name" => "required"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ]);
        }

        Permission::create([
            "name" => $validated["name"],
            "guard_name" => $validated["guard_name"]
        ]);

        return response()->json(
            [
                "message" => "Addition success."
            ],
            201
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

        $obj_permission = Permission::findOrFail($id);

        return $obj_permission->load("roles");
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
                "name" => "required|string|min:5|max:255",
                "guard_name" => "required"
            ]);
        } catch (ValidationException) {
            return response()->json([
                "message" => "Error in sent data."
            ]);
        }


        $obj_permission = Permission::findOrFail($id);
        $obj_permission->name = $validated["name"];
        $obj_permission->save();

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
        if (!$this->isAuthorized("admin", User::class)) {
            return response()->json([
                "message" => "User has not the right permissions."
            ], 401);
        }
        Permission::destroy($id);

        return response()->json(
            [
                "message" => "Deletion success."
            ]
        );
    }
}