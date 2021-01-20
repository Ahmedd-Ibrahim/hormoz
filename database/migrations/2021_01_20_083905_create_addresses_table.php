<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('city');
            $table->text('street');
            $table->integer('building_number');
            $table->integer('apartment_number');
            $table->text('phone');
            $table->text('type');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

//        Schema::table('addresses', function (Blueprint $table) {
//            $table->foreign('user_id')->on('users')
//                ->references('id')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
