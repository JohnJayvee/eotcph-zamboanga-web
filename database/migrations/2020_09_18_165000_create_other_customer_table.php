<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('address')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('status')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('occupation')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('other_customer');
    }
}
