<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(\App\Models\Nutrition::class, function (Faker $faker) {
    return [
        "name" => $faker->randomElement(["Sugar", "Proteins", "Lipid","Calcium"]),
        "quantity" => $faker->randomFloat(2, 0.1, 200),
        "food_id" => $faker->numberBetween(1,30),
    ];
});
