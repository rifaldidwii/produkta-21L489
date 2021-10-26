<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained();
            $table->string('reference');
            $table->string('merchant_ref');
            $table->string('payment_selection_type');
            $table->string('payment_method');
            $table->string('payment_name');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->integer('amount');
            $table->integer('fee_merchant');
            $table->integer('amount_received');
            $table->string('checkout_url');
            $table->string('status');
            $table->string('paid_time')->nullable();
            $table->integer('expired_time');
            $table->json('order_items');
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
        Schema::dropIfExists('receipts');
    }
}
