<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\mailing;
use Faker\Generator as Faker;

$factory->define(mailing::class, function (Faker $faker) {

    return [
        'email' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
