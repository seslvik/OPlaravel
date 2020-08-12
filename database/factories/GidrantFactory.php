<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gidrant;
use Faker\Generator as Faker;

$factory->define(Gidrant::class, function (Faker $faker) {
    $data = [
        'user_id' => rand(2,8),
        'zavod'         => $faker->randomElement(['Нафтан','Полимир']),//один из элементов массива
        'objekt'        => $faker->realText(rand(10,20)), //предложение от 5 до 8 слов
        'opisanie'      => $faker->realText(rand(100,300)),//текст от 500 до 1000 символов
        'file'          => $faker->realText(rand(10,15)),//текст от 500 до 1000 символов,
        'pos_x'         => $faker->randomFloat(3, 0.1, 0.9),//$faker->randomFloat($nbMaxDecimals = 3, $min = 0.010, $max = 0.999),
        'pos_y'         => $faker->randomFloat(3,  0.1,  0.9), //$faker->randomFloat($nbMaxDecimals = 0.900, $min = 0.010, $max = 0.999),
        'created_at'    => $faker->dateTimeBetween('-1 months', '-10 days'),//date('d.m.Y',$max = '-2 months'),
        'updated_at'    => $faker->dateTimeBetween('-9 days', '-1 days'),//date('d.m.Y',$max = '-1 months'),
    ];
    return $data;
});
