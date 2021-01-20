<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('email');
            $table->text('name');
            $table->text('official_name')->nullable();
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('Legal_papers')->nullable();
            $table->enum('is_active',['true','false'])->default('false')->nullable();
            $table->float('available')->nullable();
            $table->float('holding')->nullable();
            $table->float('total')->nullable();
            $table->text('owner_name')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('branch_name')->nullable();
            $table->integer('account_id')->nullable();
            $table->text('iban')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
//        Schema::table('vendors', function (Blueprint $table) {
//            $table->foreign('user_id')->on('users')->references('id')
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
        Schema::drop('vendors');
    }
}
