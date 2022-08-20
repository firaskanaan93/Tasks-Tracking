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
        //create 10000 normal users
         \App\Models\User::factory(10000)->create();

        //create 100 admins
         \App\Models\User::factory(100)->create([
             'role' => 'admin'
         ]);
    }
}
