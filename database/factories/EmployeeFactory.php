<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'last_name' => $faker->name,
        'first_name' => $faker->name,
        'middle_initial' => $faker->name,
        'email_address' => $faker->safeEmail,
        'department_id' => '1',
    ];
});
