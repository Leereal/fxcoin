<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notification;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    return [
        'user_id' => mt_rand(1,20), 
        'description' => $faker->text,
        'ipAddress'=>$faker->ipv4,
    ];
});
