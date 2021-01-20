<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->float('price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
//
//        Schema::table('order_products', function (Blueprint $table) {
//            $table->foreign('order_id')->on('orders')->references('id')
//                ->onDelete('cascade')->onUpdate('cascade');
//
//            $table->foreign('product_id')->on('products')->references('id')
//                ->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_products');
    }
}
