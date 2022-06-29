<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_apps', function (Blueprint $table) {
            $table->increments('id_cus_app');
            $table->string('name_cus_app')->nullable();
            $table->string('phone_cus_app');
            $table->string('pass_cus_app');
            $table->string('add_cus_app', 500)->nullable();
            $table->string('des_cus_app')->nullable();
            $table->string('sex_cus_app')->default(0);
            $table->string('email_cus_app')->nullable();
            $table->string('birth_day_cus_app')->nullable();
			$table->string('avatar')->default('NoAvatar');
            $table->string('path')->nullable();
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
        Schema::dropIfExists('user_apps');
    }
}
