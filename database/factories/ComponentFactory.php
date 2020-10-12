<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Component;
use Faker\Generator as Faker;

$factory->define(Component::class, function (Faker $faker) {

    $faker->addProvider(new \Bezhanov\Faker\Provider\Device($faker));
    $faker->addProvider(new \Bezhanov\Faker\Provider\Science($faker));
    $tag = 'COMP-' . Str::slug($faker->colorName, '-');

    return [
        'asset_tag' => $tag,
        'component_name' => 'Peri-'.$faker->chemicalElement,
        'component_type_id' => rand(1, 5),
    ];
});
