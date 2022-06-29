<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('device_key')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('permission')->default(0)->comment = ('0: nhân viên ; 1: kế toán; 2: admin');
            $table->string('password');
            $table->string('status_read')->default(0);
            $table->boolean('is_online')->default(0);
            $table->string('last_activity')->nullable();
            $table->string('avata')->nullable();
            $table->longText('FCM_token')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
};
