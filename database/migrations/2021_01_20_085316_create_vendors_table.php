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
            $table->integer('user_id');
            $table->text('email');
            $table->text('name');
            $table->text('offcial_name');
            $table->text('phone');
            $table->text('address');
            $table->text('Legal_papers');
            $table->text('is_active');
            $table->float('available');
            $table->float('holding');
            $table->float('total');
            $table->text('owner_name');
            $table->text('bank_name');
            $table->text('branch_name');
            $table->integer('account_id');
            $table->text('iban');
            $table->timestamps();
            $table->softDeletes();
        });
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
