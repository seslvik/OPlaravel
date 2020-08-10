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
            'firstname'      => 'Admin',
            'email'     => '12345@12345.12',
            'password'  => bcrypt('12345'),
            'admin'     => '1',
            'activ'     => '0',
            'avatar'     => '1',
        ];
        $cName = 1111;
        for ($i=1; $i<=7; $i++ ) {
            $categories[] = [
                'name'      => $cName,
                'firstname'      => $cName,
                'email'     => $cName.'@12345.12',
                'password'  => bcrypt($cName),
                'admin'     => '0',
                'activ'     => null,
                'avatar'     => '2',
                ];
            $cName = $cName+1111;
        }

        DB::table('users')->insert($categories);

    }
}
