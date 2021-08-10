<?php

use Faker\Generator as Faker;

$factory->define(App\Borrowing::class, function (Faker $faker) {
    
    $created_at = $faker->dateTimeBetween($startDate = '-8 months', $endDate = 'now', $timezone = null);
    return [
        
        'nombre_bien' => $faker->text($maxNbChars = 15),
        'nombre_encargado' => $faker->name,
        'cantidad' => $faker->numberBetween($min = 1, $max = 10),
        'descripcion' => $faker->text($maxNbChars = 100) ,
        'estado' => 1,

        'created_at' => $created_at,
        'fecha_devolucion' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now', $timezone = null),
        'login_id' => $faker->numberBetween($min = 2, $max = 7),
    ];

});
