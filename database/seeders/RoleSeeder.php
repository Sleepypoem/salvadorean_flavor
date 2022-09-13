<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            "name" => "admin",
            "guard_name" => "web"
        ]);

        $user = Role::create([
            "name" => "user",
            "guard_name" => "web"
        ]);

        Permission::create(["name" => "view"])->syncRoles([$admin, $user]);
        Permission::create(["name" => "create"])->assignRole($admin);
        Permission::create(["name" => "update"])->assignRole($admin);
        Permission::create(["name" => "delete"])->assignRole($admin);
    }
}