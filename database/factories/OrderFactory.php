<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(2),
        'product_id' => $faker->randomNumber(2),
        'quantity' => $faker->randomNumber(2),
        'price' => $faker->randomNumber(2),
        'payment_option' => $faker->randomElement(['esewa' ,'paypal' ,'khalti']),
    ];
});
