<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Credit;
use Faker\Generator as Faker;

$factory->define(Credit::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'name' => $faker->text,
        'number' => $faker->text,
        'expire_date' => $faker->word,
        'cvv' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
