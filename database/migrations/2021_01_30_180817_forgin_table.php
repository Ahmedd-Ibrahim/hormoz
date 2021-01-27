<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credits', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('vendor_id')->on('vendors')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('category_id')->on('categories')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('sub_category_id')->on('sub_categories')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')
                ->references('id')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('vendors', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->foreign('category_id')->on('categories')
                ->references('id')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->foreign('product_id')->on('products')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('address_id')->on('addresses')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('user_products', function (Blueprint $table) {
            $table->foreign('product_id')->on('products')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_id')->on('users')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->foreign('order_id')->on('orders')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('product_id')->on('products')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
        });



        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('product_id')->on('products')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('credits', function(Blueprint $table) {
            $table->dropForeign('credits_user_id_foreign');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign('products_vendor_id_foreign');
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_sub_category_id_foreign');
        });

        Schema::table('addresses', function(Blueprint $table) {
            $table->dropForeign('addresses_user_id_foreign');
        });

        Schema::table('addresses', function(Blueprint $table) {
            $table->dropForeign('addresses_user_id_foreign');
        });

        Schema::table('vendors', function(Blueprint $table) {
            $table->dropForeign('vendors_user_id_foreign');
        });

        Schema::table('sub_categories', function(Blueprint $table) {
            $table->dropForeign('sub_categories_category_id_foreign');
        });

        Schema::table('galleries', function(Blueprint $table) {
            $table->dropForeign('galleries_product_id_foreign');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
            $table->dropForeign('orders_address_id_foreign');
        });

        Schema::table('user_products', function(Blueprint $table) {
            $table->dropForeign('user_products_product_id_foreign');
            $table->dropForeign('user_products_user_id_foreign');

        });

        Schema::table('order_products', function(Blueprint $table) {
            $table->dropForeign('order_products_order_id_foreign');
            $table->dropForeign('order_products_product_id_foreign');

        });


        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign('favorites_user_id_foreign');
            $table->dropForeign('favorites_product_id_foreign');

        });

    }
}
