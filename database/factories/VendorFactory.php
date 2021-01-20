<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'email' => $faker->text,
        'name' => $faker->text,
        'offcial_name' => $faker->text,
        'phone' => $faker->text,
        'address' => $faker->text,
        'Legal_papers' => $faker->text,
        'is_active' => $faker->text,
        'available' => $faker->randomDigitNotNull,
        'holding' => $faker->randomDigitNotNull,
        'total' => $faker->randomDigitNotNull,
        'owner_name' => $faker->text,
        'bank_name' => $faker->text,
        'branch_name' => $faker->text,
        'account_id' => $faker->randomDigitNotNull,
        'iban' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
