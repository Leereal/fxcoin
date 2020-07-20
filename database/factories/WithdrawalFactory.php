<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Withdrawal;
use Faker\Generator as Faker;

$factory->define(Withdrawal::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 10, 3000),
        'reason' => 'Want Money',
        'transaction_code' => mt_rand(100000,999999),   
        'payment_detail_id' => mt_rand(1,10),   
        'user_id' => mt_rand(1,20), 
        'comments' =>$faker->text(), 
        'ipAddress'=>$faker->ipv4, 
    ];
});
