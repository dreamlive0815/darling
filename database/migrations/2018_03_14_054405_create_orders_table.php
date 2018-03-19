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
            $table->morphs('sender');
            $table->integer('seller_id');
            $table->string('sender_address');
            $table->string('sender_tel');
            $table->integer('receiver_id')->nullable();
            $table->string('receiver_address');
            $table->string('receiver_tel');
            $table->string('user_note')->nullable();
            $table->float('reward_for_carrier');
            $table->integer('carrier_id')->nullable();
            $table->timestamp('carrier_get_commodities_time')->nullable();
            $table->timestamp('carrier_expect_complete_time')->nullable();
            $table->timestamp('carrier_complete_time')->nullable();
            $table->string('carrier_current_position')->nullable();
            $table->float('carrier_total_move_distance')->nullable();
            $table->string('state')->default('unsend');
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
