<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Computer;
use Faker\Generator as Faker;

$factory->define(Computer::class, function (Faker $faker) {
    return [
        'asset_tag' => $faker->localIpv4,
        'pc_name' => $faker->name,
        'type' => rand( 1, 2),
        'department_id' => rand( 1, 5),
    ];
});
