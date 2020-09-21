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
            $table->string('customer_id')->nullable();
            $table->string('income_salary')->nullable();
            $table->string('income_salary_two')->nullable();
            $table->string('business_sales')->nullable();
            $table->string('business_sales_two')->nullable();
            $table->string('income_real_state')->nullable();
            $table->string('income_real_state_two')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('interest')->nullable();
            $table->string('total_tax_due')->nullable();
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
