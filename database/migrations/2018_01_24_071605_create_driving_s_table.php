<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivingSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('name')->nullable();
            $table->string('id_card')->nullable();
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->string('c_address')->nullable();
            $table->string('p_address')->nullable();
            $table->string('instructor')->nullable();
            $table->string('rate')->nullable();
            $table->string('remarks')->nullable();
            $table->string('finisheddate')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('licence_url')->nullable();
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
        Schema::dropIfExists('driving_s');
    }
}
