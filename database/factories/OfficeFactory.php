<?php

use Faker\Generator as Faker;

$factory->define(App\Office::class, function (Faker $faker) {
    return [
        'nombre_oficina' => $faker->company,
    ];
});
