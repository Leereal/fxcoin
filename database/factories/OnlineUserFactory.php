<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OnlineUser;
use Faker\Generator as Faker;

$factory->define(OnlineUser::class, function (Faker $faker) {
    return [
        'user_id' => mt_rand(1,20),
        'sign_out' => \Carbon\Carbon::createFromTimeStamp($faker->dateTimeBetween('-2 days', 'now')->getTimestamp()),
        'online_status' => mt_rand(0,2), 
        'ipAddress'=>$faker->ipv4,  
    ];
});
