<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default(0)->nullable();
            $table->string('customer_id')->default(0)->nullable();
            $table->string('code')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('processing_fee_code')->nullable();
            $table->string('amount')->nullable();
            $table->string('application_name')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_option')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default("UNPAID")->nullable();
            $table->string('transaction_status')->default("PENDING")->nullable();
            $table->string('total_amount')->nullable();
            $table->string('convenience_fee')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('status')->default("PENDING")->nullable();
            $table->string('processor_user_id')->nullable();
            $table->timestamp('application_date')->nullable();
            $table->timestamp('modified_at')->nullable();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('other_transaction');
    }
}
