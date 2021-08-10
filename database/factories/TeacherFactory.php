<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {

    $created_at = $faker->dateTimeBetween($startDate = '-8 months', $endDate = 'now', $timezone = null);
    return [
        'nombres' => $faker->firstName() ,
        'apellidos' => $faker->lastName,
        'dni' => $faker->numerify($string = '########'),
        'descripcion' => $faker->text($maxNbChars = 100) ,
        'estado' => $faker->numberBetween($min = 0, $max = 1),
        'login_id' => $faker->numberBetween($min = 2, $max = 7),
        'created_at' => $created_at,
        'leave_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now', $timezone = null)
    ];
});
