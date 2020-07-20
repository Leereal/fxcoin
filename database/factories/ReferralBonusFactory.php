<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ReferralBonus;
use Faker\Generator as Faker;

$factory->define(ReferralBonus::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 15, 3000),        
        'user_id' => mt_rand(1,20),        
        'investment_id' => mt_rand(1,20),
    ];
});
