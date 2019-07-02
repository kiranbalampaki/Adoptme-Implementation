<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->firstName,
        'product_image' => $faker->image('assets/uploads/profilepictures',400,300, null, false),
        'price' => $faker->randomNumber(3),
        'description' => $faker->paragraph,
        'stock' => $faker->randomNumber(2),
        'category_id' => $faker->randomNumber(1),
    ];
});
