<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('fb_id')->nullable();
            $table->string('gmail_id')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('email_code')->nullable();
            $table->string('phone',15)->unique()->nullable();
            $table->enum('phone_verified',['true','false'])->nullable();
            $table->string('password');
            $table->enum('role',['user','seller','admin'])->default('user');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
