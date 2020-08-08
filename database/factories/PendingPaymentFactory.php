<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PendingPayment;
use Faker\Generator as Faker;

$factory->define(PendingPayment::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 10, 3000),      
        'transaction_code' => mt_rand(100000,999999),   
        'market_place_id' => mt_rand(1,10),
        'payment_method_id' => mt_rand(1,5),
        'package_id' => mt_rand(1,3),   
        'user_id' => mt_rand(1,20), 
        'expiration_time' => $faker->dateTimeBetween('now', '+2 days'), 
        'comment' =>$faker->text(), 
        'ipAddress'=>$faker->ipv4, 
    ];
});
