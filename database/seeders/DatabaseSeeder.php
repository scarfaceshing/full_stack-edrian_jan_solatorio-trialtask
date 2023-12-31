<?php

namespace Database\Seeders;

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
        /* 
            Call UserSeeder class to seed data to database
        */

        $this->call([
            UserSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
