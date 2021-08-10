<?php

use App\Office;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Visitor::class, function (Faker $faker) {

    $created_at = $faker->dateTimeBetween($startDate = '-8 months', $endDate = 'now', $timezone = null);
    return [
        'dni' => $faker->numerify($string = '########'),
        'nombres' => $faker->firstName() ,
        'apellidos' => $faker->lastName,

        'oficina_id' => Office::all()->random()->id,

        'motivo' => $faker->text($maxNbChars = 100) ,
        'estado' => $faker->numberBetween($min = 0, $max = 1),
        'created_at' => $created_at,
        'leave_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now', $timezone = null),
        'login_id' => User::where('role_id', 2)->get()->random()->id,
    ];
});
