<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Peripheral;
use Faker\Generator as Faker;

$factory->define(Peripheral::class, function (Faker $faker) {
    return [
        'asset_tag' => $faker->localIpv4,
        'peripheral_name' => $faker->name,
        'peripheral_type' => rand( 1, 4 ),
    ];
});
