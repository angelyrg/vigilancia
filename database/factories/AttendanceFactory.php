<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Attendance::class, function (Faker $faker) {

    $created_at = $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now', $timezone = null);

    return [
        //'dia_semana' => $faker->numberBetween($min = 0, $max = 6),
        'estado' => 1,

        'created_at' => $created_at,
        'updated_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = '+1 day', $timezone = null),

        'user_id' => User::where('role_id', 2)->get()->random()->id,
    ];
});
