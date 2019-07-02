<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'first_user' => $faker->randomDigitNotNull,
        'second_user' => $faker->randomDigitNotNull,
        'pet_id' => $faker->randomNumber(2),
    ];
});
