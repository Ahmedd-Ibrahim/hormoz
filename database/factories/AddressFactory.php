<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'first_name' => $faker->word,
        'last_name' => $faker->word,
        'city' => $faker->randomDigitNotNull,
        'street' => $faker->randomDigitNotNull,
        'building_number' => $faker->randomDigitNotNull,
        'apartment_number' => $faker->randomDigitNotNull,
        'phone' => $faker->text,
        'type' => $faker->text,
        'descriotion' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
