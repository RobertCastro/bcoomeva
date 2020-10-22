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
            "name" => "Robert Castro",
            "email" => "oneroberth@gmail.com",
            "password" => bcrypt("1234"),
        ]);

        User::factory()->create([
            "name" => "Artemedia",
            "email" => "gerencia@artemedia.com.co",
            "password" => bcrypt("0JZaU@Eo"),
        ]);

        Project::factory(2)->create();
        Data::factory(2000)->create();
    }
}
