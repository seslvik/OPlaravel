<?php

use App\Models\Gidrant;
use App\Models\Operplan;
use App\Models\Polygon;
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
         factory(Operplan::class, 1000)->create();
         factory(Gidrant::class, 1000)->create();
         factory(Polygon::class, 1000)->create();
    }
}
