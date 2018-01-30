<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupSmsStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_sms_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('groupsms_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status')->nullable();
            $table->integer('delivered')->default('0')->nullable();
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
        Schema::dropIfExists('group_sms_statuses');
    }
}
