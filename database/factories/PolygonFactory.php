<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Polygon;
use Faker\Generator as Faker;

$factory->define(Polygon::class, function (Faker $faker) {
    return [
            'user_id'       => rand(2,8),
            'zavod'         => $faker->randomElement(['Нафтан','Полимир']),//один из элементов массива
            'opisanie'      => $faker->realText(rand(100,300)),//текст от 500 до 1000 символов
            'color'         => $faker->hexColor,//цвет
            'pos_x_1'       => $faker->randomFloat(3, 0.1, 0.9),
            'pos_y_1'       => $faker->randomFloat(3, 0.1, 0.9),
            'pos_x_2'       => $faker->randomFloat(3, 0.1, 0.9),
            'pos_y_2'       => $faker->randomFloat(3, 0.1, 0.9),
            'pos_x_3'       => $faker->randomFloat(3, 0.4, 0.8),
            'pos_y_3'       => $faker->randomFloat(3, 0.4, 0.8),
            'pos_x_4'       => $faker->randomFloat(3, 0.4, 0.8),
            'pos_y_4'       => $faker->randomFloat(3, 0.4, 0.8),
            'created_at'    => $faker->dateTimeBetween('-1 months', '-10 days'),//date('d.m.Y',$max = '-2 months'),
            'updated_at'    => $faker->dateTimeBetween('-9 days', '-1 days'),//date('d.m.Y',$max = '-1 months'),
    ];
});
