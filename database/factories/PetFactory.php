<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Pet;
use Faker\Generator as Faker;

$factory->define(Pet::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['cat' ,'dog']),
        'pet_photo' => $faker->image('assets/uploads/profilepictures',400,300, null, false),
        'name' => $faker->firstName,
        'gender' => $faker->randomElement(['m' ,'f']),
        'age' => $faker->randomElement(['young' ,'adult' ,'senior']),
        'size' => $faker->randomElement(['small' ,'medium' ,'large' ,'extra large']),
        'color' => $faker->randomElement(['black' ,'white' ,'brown' ,'grey' ,'multicolor']),
        'is_vaccinated' => $faker->randomElement(['1' ,'0']),
        'is_dewormed' => $faker->randomElement(['1' ,'0']),
        'is_adopted' => $faker->randomElement(['1' ,'0']),
        'details' => $faker->paragraph,
        'user_id' => $faker->randomNumber(3),
    ];
});
