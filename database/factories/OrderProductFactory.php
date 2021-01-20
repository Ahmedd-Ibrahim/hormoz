<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderProduct;
use Faker\Generator as Faker;

$factory->define(OrderProduct::class, function (Faker $faker) {

    return [
        'order_id' => $faker->randomDigitNotNull,
        'product_id' => $faker->randomDigitNotNull,
        'price' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
