<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('taxi_id')->nullable();
            $table->string('driverName')->nullable();
            $table->string('driverIdNo')->nullable();
            $table->string('driverTempAdd')->nullable();
            $table->string('driverPermAdd')->nullable();
            $table->string('driverMobile')->nullable();
            $table->string('driverEmail')->nullable();
            $table->string('driverLicenceNo')->nullable();
            $table->string('driverLicenceExp')->nullable();
            $table->string('driverPermitNo')->nullable();
            $table->string('driverPermitExp')->nullable();
            $table->string('photoURL')->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
