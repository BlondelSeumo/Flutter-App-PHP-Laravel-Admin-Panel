<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Faq::class, function (Faker $faker) {
    return [
        'question' => $faker->text(100),
        'answer' => $faker->realText(),
        'faq_category_id' => $faker->numberBetween(1, 4)
    ];
});
