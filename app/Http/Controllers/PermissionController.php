<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $validateFields = [
            "name" => "required",
            "guard_name" => "required"
        ];

        $validatedFields = $request->validate($validateFields);

        Permission::create([
            "name" => $validatedFields["name"],
            "guard_name" => $validatedFields["guard_name"]
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
        $obj_permission = Permission::findOrFail($id);

        return $obj_permission;
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
            "guard_name" => "required"
        ];

        $validatedFields = $request->validate($validateFields);

        $obj_permission = Permission::findOrFail($id);
        $obj_permission->name = $validatedFields["name"];
        $obj_permission->save();

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
        Permission::destroy($id);

        return response()->json(
            [
                "message" => "Delete success."
            ]
        );
    }
}