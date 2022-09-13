<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//spatie

use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {/* 
        $this->middleware("permission:view_role ", ["only" => ["index"]]);
        $this->middleware("permission:create_role", ["only" => ["store"]]);
        $this->middleware("permission:edit_role", ["only" => ["update"]]);
        $this->middleware("permission:delete_role", ["only" => ["destroy"]]); */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $validateFields = [
            "name" => "required",
            "permission" => "required",
            "guard_name" => "required"
        ];

        $validatedFields = $request->validate($validateFields);

        $obj_role = Role::create([
            "name" => $validatedFields["name"],
            "permission" => $validatedFields["permission"],
            "guard_name" => $validatedFields["guard_name"]
        ]);
        $obj_role->syncPermissions($request->permission);

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
        $obj_role = Role::findOrFail($id);

        return $obj_role;
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
        $validateFields = [
            "name" => "required",
            "permission" => "required",
            "guard_name" => "required"
        ];

        $validatedFields = $request->validate($validateFields);

        $obj_role = Role::findOrFail($id);
        $obj_role->name = $validatedFields["name"];
        $obj_role->guard_name = $validatedFields["guard_name"];
        $obj_role->save();

        $obj_role->syncPermissions($validatedFields["permission"]);

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
        Role::destroy($id);

        return response()->json(
            [
                "message" => "Delete success."
            ]
        );
    }
}