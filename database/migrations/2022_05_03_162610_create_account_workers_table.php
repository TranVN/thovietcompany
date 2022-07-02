<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_workers', function (Blueprint $table) {
            $table->id();
            $table ->integer('id_worker');
            $table ->string('acc_worker');
            $table ->string('pass_worker');
            $table ->string('device_key')->nullable();
            $table->longText('FCM_token')->nullable();
            $table->string('last_active')->nullable();
            $table->tinyInteger('active')->default(0)->comment('0: tạm khóa; 1: mở; 2: khóa vĩnh viễn');
            $table ->tinyInteger('time_log')->default(0);
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
        Schema::dropIfExists('account_workers');
    }
}
