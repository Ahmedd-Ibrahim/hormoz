<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->text('image');
            $table->enum('is_primary',['true','false'])->default('false');
            $table->integer('product_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

//        Schema::table('galleries', function (Blueprint $table) {
//            $table->foreign('product_id')->on('products')->references('id')
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
        Schema::drop('galleries');
    }
}
