<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaxiCenter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxi_centers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_id')->nullable();
            
            $table->string('name')->nullable();
            $table->string('cCode')->nullable();
            $table->string('address')->nullable();
            
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('fax')->nullable();
            
            $table->string('active')->nullable();
            
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
        //
    }
}
