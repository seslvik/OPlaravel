<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Operplan;
use Faker\Generator as Faker;

$factory->define(Operplan::class, function (Faker $faker) {
    //$faker = Faker::create(ru_RU);
    //$randomFile = $faker->file($sourceDir='/home/gujarat/fakerFile/video', $targetDir='./public/videoLibrary', false);
    $data = [
        'user_id' => rand(2,8),
        'zavod'         => $faker->randomElement(['Нафтан','Полимир']),//один из элементов массива
        'objekt'        => $faker->realText(rand(10,20)), //текст от 5 до 8 слов
        'opisanie'      => $faker->realText(rand(100,300)),//текст от 500 до 1000 символов
        'file'          => $faker->realText(rand(10,15)),//$faker->file($sourceDir = '/storage', $targetDir = '/storage'), // '/path/to/targetDir/13b73edae8443990be1aa8f1a483bc27.jpg'////текст от 500 до 1000 символов,
        'pos_x'         => $faker->randomFloat(3, 0.01, 0.9),//$faker->randomFloat($nbMaxDecimals = 3, $min = 0.010, $max = 0.999),
        'pos_y'         => $faker->randomFloat(3,  0.01,  0.9), //$faker->randomFloat($nbMaxDecimals = 0.900, $min = 0.010, $max = 0.999),
        'created_at'    => $faker->dateTimeBetween('-1 months', '-10 days'),//date('d.m.Y',$max = '-2 months'),
        'updated_at'    => $faker->dateTimeBetween('-9 days', '-1 days'),//date('d.m.Y',$max = '-1 months'),
    ];
    return $data;
});
