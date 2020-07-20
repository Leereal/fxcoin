<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bonus;
use Faker\Generator as Faker;

$factory->define(Bonus::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 15, 3000),
        'description' => $faker->word(10),        
        'user_id' => mt_rand(1,20), 
    ];
});
