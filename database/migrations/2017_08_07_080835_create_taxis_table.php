<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('callcode_id')->nullable();
            $table->string('taxiNo')->nullable();
            $table->string('taxiChasisNo')->nullable();
            $table->string('taxiEngineNo')->nullable();
            $table->string('taxiBrand')->nullable();
            $table->string('taxiModel')->nullable();
            $table->string('taxiColor')->nullable();
            $table->string('taxiOwnerName')->nullable();
            $table->string('taxiOwnerMobile')->nullable();
            $table->string('taxiOwnerEmail')->nullable();
            $table->string('taxiOwnerAddress')->nullable();
            $table->string('registeredDate')->nullable();
            $table->string('anualFeeExpiry')->nullable();
            $table->string('roadWorthinessExpiry')->nullable();
            $table->string('insuranceExpiry')->nullable();
            $table->string('rate')->nullable();
            $table->string('state')->default('0');
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
        Schema::dropIfExists('taxis');
    }
}
