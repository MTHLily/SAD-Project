<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Component;
use Faker\Generator as Faker;

$factory->define(Component::class, function (Faker $faker) {
    return [
        'asset_tag' => $faker->localIpv4,
        'component_name' => $faker->languageCode,
        'component_type_id' => rand(1, 5),
    ];
});
