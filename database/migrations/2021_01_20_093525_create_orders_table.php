<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->integer('order_number');
            $table->float('total');
            $table->enum('status',['waiting','preparing','wait_delivery','delivering','completed','canceled']);
            $table->timestamps();
            $table->softDeletes();
        });
//        Schema::table('orders', function (Blueprint $table) {
//            $table->foreign('user_id')->on('users')->references('id')
//                ->onUpdate('cascade')->onDelete('cascade');
//
//            $table->foreign('address_id')->on('addresses')->references('id')
//                ->onUpdate('cascade')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
