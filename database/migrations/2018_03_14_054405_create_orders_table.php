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
            $table->string('sender_address');
            $table->string('receiver_address');
            $table->string('receiver_tel');
            $table->float('reward_for_carrier');
            $table->string('note_for_carrier')->nullable();
            $table->timestamp('complete_before')->nullable();
            $table->integer('carrier_status_id')->nullable();
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
