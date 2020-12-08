<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Food::class, function (Faker $faker) {
    $foods = [
        'Big Smokey Burgers',
        'Italian Sausage Soup',
        'California Italian Wedding Soup',
        'Chicken Noodle Soup',
        'Pasta Campanelle',
        'Pasta Pappardelle',
        'Acini di Pepe',
        'Angel Hair',
        'Pizza al Pesto',
        'Pizza Valtellina',
        'Pizza Montanara',
        'Pizza Margherita',
        'American fried rice',
        'Calas',
        'Cedar Planked Salmon',
        'Cucur Udang Kuah Kacang',
        'Italian Sausage Soup',
        'Soup',
    ];
    $price = $faker->randomFloat(2,10,50);
    $discountPrice = $price - $faker->randomFloat(2,1,10);
    return [
        'name' => $faker->randomElement($foods),
        'price' => $price,
        'discount_price' => $faker->randomElement([$discountPrice,0]),
        'description' => $faker->text,
        'weight' => $faker->randomFloat(2,0.1,500),
        'package_items_count' => $faker->numberBetween(1,6),
        'unit' => $faker->randomElement(['L','g','Kg','ml']),
        'featured' => $faker->boolean,
        'deliverable' =>  $faker->boolean,
        'restaurant_id' => $faker->numberBetween(1,10),
        'category_id' => $faker->numberBetween(1,6),
    ];
});
