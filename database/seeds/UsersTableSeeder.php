<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $categories[] = [
            'name'      => '12345',
            'email'     => '12345@12345.12',
            'password'  => bcrypt('12345'),
            'admin'     => '1'
        ];
        $cName = 1111;
        for ($i=1; $i<=7; $i++ ) {
            $categories[] = [
                'name'      => $cName,
                'email'     => $cName.'@12345.12',
                'password'  => bcrypt($cName),
                'admin'     => '0'
                ];
            $cName = $cName+1111;
        }

        DB::table('users')->insert($categories);

    }
}
