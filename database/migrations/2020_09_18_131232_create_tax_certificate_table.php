<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_certificate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->nullable();
            $table->string('other_customer_id')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('income_salary')->nullable();
            $table->string('business_sales')->nullable();
            $table->string('income_real_state')->nullable();
            $table->string('basic_community_tax')->nullable();
            $table->string('additional_tax')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('interest')->nullable();
            $table->string('total_amount')->nullable();
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
        Schema::dropIfExists('tax_certificate');
    }
}
