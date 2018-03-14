<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nickname')->nullable();
            $table->string('realname')->nullable();
            $table->string('sex', 3)->nullable();
            $table->integer('age')->nullable();
            $table->string('job')->nullable();
            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->string('description')->nullable();
            $table->integer('state')->nullable();
            $table->boolean('is_corridor')->default(0);
            $table->integer('credit_score')->default(50);
            $table->string('avatar')->nullable();
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
