<?php

use Faker\Generator as Faker;

$factory->define(App\Incident::class, function (Faker $faker) {

    return [
        'nombre_incidente' => $faker->text($maxNbChars = 15),
        'descripcion' => $faker->text($maxNbChars = 100),

        'created_at' => $faker->dateTimeBetween($startDate = '-8 months', $endDate = 'now', $timezone = null),
        'login_id' => $faker->numberBetween($min = 2, $max = 7),
    ];
});
