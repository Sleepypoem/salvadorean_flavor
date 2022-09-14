<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin user
        User::create([
            'name' => "Admin of admins",
            'email' => "salvadorean_food@admin.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole("admin");

        Image::create([
            "title" => "default_user.png",
            "image" => "/public/user_images/default.png",
            "imageable_type" => "App\Models\User",
            "imageable_id" => "1"
        ]);
    }
}