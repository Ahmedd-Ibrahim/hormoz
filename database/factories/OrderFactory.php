<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'order_number' => $faker->randomDigitNotNull,
        'total' => $faker->randomDigitNotNull,
        'address_id' => $faker->randomDigitNotNull,
        'status' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
