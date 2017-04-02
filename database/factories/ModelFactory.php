<?php

use App\Models\Student;
use App\Models\User;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Student::class, function (Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});

$factory->define(User::class, function (Generator $faker) {
    $firstName = $faker->firstName;

    return [
        'first_name' => $firstName,
        'last_name' => $faker->lastName,
        'email' => "$firstName@mail.com",
        'password' => Hash::make($firstName . '123'),
    ];
});