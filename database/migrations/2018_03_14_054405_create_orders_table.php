<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('seller_id');
            $table->integer('sender_id');
            $table->integer('carrier_id')->nullable();
            $table->string('sender_address');
            $table->string('receiver_address');
            $table->string('receiver_tel');
            $table->string('note_for_carrier')->nullable();
            $table->timestamp('carrier_accept_time')->nullable();
            $table->timestamp('carrier_fetch_time')->nullable();
            $table->timestamp('carrirer_arrive_expect_time')->nullable();
            $table->string('carrier_position')->nullable();
            $table->timestamp('carrirer_arrive_time')->nullable();
            //$table->float('total_price');
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
}
