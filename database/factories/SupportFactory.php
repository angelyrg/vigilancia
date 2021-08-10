<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Support::class, function (Faker $faker) {

    $created_at = $faker->dateTimeBetween($startDate = '-8 months', $endDate = 'now', $timezone = null);
    return [
        'vigilante_id' => User::where('role_id', 2)->get()->random()->id,
        'oficina' => $faker->company,

        'documento' => $faker->text($maxNbChars = 20) ,
        'destino' => $faker->address,
        'estado' => 1,

        'created_at' => $created_at,
        'fecha_retorno' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now', $timezone = null),
        'login_id' => $faker->numberBetween($min = 2, $max = 7),
    ];

});
