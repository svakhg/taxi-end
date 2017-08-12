<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('taxi_id')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('total')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('gstAmount')->nullable();
            $table->integer('totalAmount')->nullable();
            $table->string('slipNo')->nullable();
            $table->text('desc')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('paymentStatus')->default('0');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_histories');
    }
}
