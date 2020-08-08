<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MarketPlace;
use Faker\Generator as Faker;

$factory->define(MarketPlace::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 10, 3000),
        'balance' => $faker->randomFloat(2, 15, 3000),
        'reason' => 'Need Money',
        'transaction_code' => mt_rand(100000,999999),   
        'payment_detail_id' => mt_rand(1,10), 
        'investment_id' => mt_rand(1,10),   
        'user_id' => mt_rand(1,20), 
        'comment' =>$faker->text(), 
        'ipAddress'=>$faker->ipv4,
    ];
});
