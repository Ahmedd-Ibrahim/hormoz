<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('sub_category_id')->unsigned();
            $table->text('name');
            $table->integer('maximum_stock_for_client');
            $table->float('weight')->nullable();
            $table->text('sku');
            $table->longText('description');
            $table->integer('stock');
            $table->float('regular_price');
            $table->float('sale_percent')->nullable()->default(0);
            $table->date('sale_expire_date')->nullable();
            $table->text('catching_word')->nullable();
            $table->text('code');
            $table->enum('status',['active','deactivate']);
            $table->enum('slide',['true','false']);
            $table->text('brand')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
//        Schema::table('products', function (Blueprint $table) {
//            $table->foreign('vendor_id')->on('vendors')->references('id')
//                ->onUpdate('cascade')->onDelete('cascade');
//
//            $table->foreign('category_id')->on('categories')->references('id')
//                ->onUpdate('cascade')->onDelete('cascade');
//
//            $table->foreign('sub_category_id')->on('sub_categories')->references('id')
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
        Schema::drop('products');
    }
}
