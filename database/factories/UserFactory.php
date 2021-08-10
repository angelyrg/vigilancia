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
    return [
        'name' => $faker->firstName() ,
        'lastname' => $faker->lastName,
        'dni' => $dni,
        'phone' => $faker->numerify($string = '#########'),
        'password' => bcrypt($dni),        
        'role_id' => '2',
        'remember_token' => str_random(10),
    ];
});
