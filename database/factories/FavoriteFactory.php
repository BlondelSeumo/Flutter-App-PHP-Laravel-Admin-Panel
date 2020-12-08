<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Favorite::class, function (Faker $faker) {
    return [
        'food_id' => $faker->numberBetween(1, 30),
        'user_id' => $faker->numberBetween(1, 6)
    ];
});
