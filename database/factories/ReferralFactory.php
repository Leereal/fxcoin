<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Referral;
use Faker\Generator as Faker;

$factory->define(Referral::class, function (Faker $faker) {
    return [
        'user_id' => mt_rand(1,5), 
        'referred_user_id' => mt_rand(6,20), 
    ];
});
