<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'middle_initial' => $faker->lastName,
        'email_address' => $faker->safeEmail,
        'department_id' => rand(1, 5),
    ];
});
