<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrierStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('carrier_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('want_order_id');
            $table->timestamp('want_time')->nullable();
            $table->timestamp('accept_time')->nullable();
            $table->timestamp('get_commodities_time')->nullable();
            $table->timestamp('expect_complete_time')->nullable();
            $table->timestamp('complete_time')->nullable();
            $table->string('current_position')->nullable();
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
        //
        Schema::dropIfExists('carrier_status');
    }
}
