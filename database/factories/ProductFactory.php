<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Product::class, function (Faker\Generator $faker) {

    // generate dummies
    $name = $faker->words($nb = 5, $asText = true);
    $slug = str_slug($name);
    $stock = rand(1,10);
    $price = rand(10,100);
    $description = $faker->paragraphs($nb = 3, $asText = true);

    // insert to database
    return [
        'name' => $name,
        'slug' => $slug,
        'stock' => $stock,
        'price' => $price,
        'description' => $description,
    ];
});
