<?php

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
         $this->call(UsersTableSeeder::class);
         factory(\App\Models\Operplans::class, 50)->create();
         factory(\App\Models\Gidrants::class, 50)->create();
    }
}
