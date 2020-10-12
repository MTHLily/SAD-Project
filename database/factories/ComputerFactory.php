<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Computer;
use Faker\Generator as Faker;

$factory->define(Computer::class, function (Faker $faker) {

    $faker->addProvider(new \Bezhanov\Faker\Provider\Medicine($faker));
    $tag = 'PC-' . Str::slug($faker->colorName, '-');

    return [
        'asset_tag' => $tag,
        'pc_name' => 'Com-'.$faker->medicine,
        'type' => rand( 1, 2),
        'department_id' => rand( 1, 5),
    ];
});
