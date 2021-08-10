<?php

use Faker\Generator as Faker;

$factory->define(App\Vehicle::class, function (Faker $faker) {

    $created_at = $faker->dateTimeBetween($startDate = '-8 months', $endDate = 'now', $timezone = null);
    return [
        'placa' => $faker->numerify($string='#######'),
        'conductor' => $faker->name,
        'dni_conductor' => $faker->numerify($string='########'),
        'tipo_vehiculo' => $faker->word,
        'color' => $faker->word,
        'motivo' => $faker->text($maxNbChars = 100) ,
        'estado' => 1,
        'propiedad_epis' => $faker->numberBetween($min = 0, $max = 1),

        'created_at' => $created_at,
        'leave_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now', $timezone = null),
        'login_id' => $faker->numberBetween($min = 2, $max = 7),
    ];
});
