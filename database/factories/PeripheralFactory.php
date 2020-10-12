<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Peripheral;
use Faker\Generator as Faker;

$factory->define(Peripheral::class, function (Faker $faker) {

    $faker->addProvider( new \Bezhanov\Faker\Provider\Device( $faker ) );
    $tag = 'PERI-' . Str::slug( $faker->colorName, '-');

    return [
        'asset_tag' => $tag,
        'peripheral_name' => $faker->deviceModelName,
        'peripheral_type' => rand( 1, 4 ),
    ];
});
