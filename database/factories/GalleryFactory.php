<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Gallery::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'restaurant_id' => $faker->numberBetween(1, 10)
    ];
});
