<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViolatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('ticket_no')->nullable();
            $table->string('p_firstname')->nullable();
            $table->string('p_middlename')->nullable();
            $table->string('p_lastname')->nullable();
            $table->string('place_of_violation')->nullable();
            $table->string('date_time')->nullable();
            $table->string('violation')->nullable();
            $table->string('violation_name')->nullable();
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
        Schema::dropIfExists('violators');
    }
}
