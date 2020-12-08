<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(\App\Models\Extra::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['XL','L','S','5L','2L','Tomato','Oil','Cheese','Tuna']),
        'description' => $faker->sentence(4),
        'price' => $faker->randomFloat(2,10,50),
        'food_id' => $faker->numberBetween(1,30),
        'extra_group_id' => $faker->numberBetween(1,3),
    ];
});
