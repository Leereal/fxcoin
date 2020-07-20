<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Investment;
use Faker\Generator as Faker;

$factory->define(Investment::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 10, 3000),
        'description' => 'Deposit',
        'transaction_code' => mt_rand(100000,999999),      
        'expected_profit'=>$faker->randomFloat(2, 10, 3000),
        'balance' => $faker->randomFloat(2, 15, 3000),
        'package_id' => mt_rand(1,3),
        'user_id' => mt_rand(1,20), 
        'due_date' => $faker->dateTimeBetween('now', '+2 months'),
        'payment_method_id' => mt_rand(1,6),
        'comments' =>$faker->text(),      
        'pop'=>$faker->image(public_path('images'),400,300, null, false),            
        'ipAddress'=>$faker->ipv4,
        'currency_id' => 1,  
    ];
});
