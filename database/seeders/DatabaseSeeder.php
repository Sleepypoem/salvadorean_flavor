<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //creating roles
        $this->call(RoleSeeder::class);

        //creating users
        $this->call(UserSeeder::class);

        //creating recipe
        $this->call(RecipeSeeder::class);

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole("user");
        });
    }
}