<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PaymentDetail;
use Faker\Generator as Faker;

$factory->define(PaymentDetail::class, function (Faker $faker) {
    return [
        'user_id' => mt_rand(1,20),
        'payment_method_id' => mt_rand(1,30),
        'account_number' => mt_rand(100000,999999),      
        'ipAddress'=>$faker->ipv4,           
    ];
});
