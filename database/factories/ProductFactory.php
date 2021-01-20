<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'id' => $faker->word,
        'vendor_id' => $faker->randomDigitNotNull,
        'name' => $faker->text,
        'category_id' => $faker->randomDigitNotNull,
        'maxmim_stock_for_client' => $faker->randomDigitNotNull,
        'weight' => $faker->randomDigitNotNull,
        'sku' => $faker->text,
        'description' => $faker->word,
        'stock' => $faker->randomDigitNotNull,
        'regluar_price' => $faker->randomDigitNotNull,
        'is_sale' => $faker->randomDigitNotNull,
        'sale_precent' => $faker->randomDigitNotNull,
        'sale_expire_date' => $faker->word,
        'catching_word' => $faker->text,
        'code' => $faker->text,
        'status' => $faker->text,
        'brand' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
