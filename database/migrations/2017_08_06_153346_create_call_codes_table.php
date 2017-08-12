<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('center_id')->nullable();
            $table->string('callCode')->nullable();
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
        Schema::dropIfExists('call_codes');
    }
}
