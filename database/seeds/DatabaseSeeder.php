<?php

use App\Models\Gidrant;
use App\Models\Operplan;
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
         factory(Operplan::class, 50)->create();
         factory(Gidrant::class, 50)->create();
    }
}
