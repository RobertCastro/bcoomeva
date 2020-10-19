<?php

namespace Database\Seeders;

use App\Models\Data;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "name" => "robertcastro",
            "email" => "oneroberth@gmail.com",
            "password" => bcrypt("1234"),
        ]);

        User::factory()->create([
            "name" => "Alejo Castro",
            "email" => "hi@alecastro.com",
            "password" => bcrypt("1234"),
        ]);

        Project::factory(200)->create();
        Data::factory(50)->create();
    }
}
