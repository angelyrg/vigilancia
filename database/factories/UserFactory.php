<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    
    $dni = $faker->numerify($string = '########');
    $contrat_start = $faker->dateTimeBetween($startDate = '-8 months', $endDate = 'now', $timezone = null);

    return [
        'name' => $faker->firstName() ,
        'lastname' => $faker->lastName,
        'dni' => $dni,
        'phone' => $faker->numerify($string = '#########'),
        'password' => bcrypt($dni),        
        'role_id' => '2',
        'contract_start' => $contrat_start,
        'contract_end' => $faker->dateTimeBetween($startDate = $contrat_start, $endDate = 'now', $timezone = null),

        'remember_token' => str_random(10),
    ];
});
