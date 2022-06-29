<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeedWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('need_works', function (Blueprint $table) {
            $table->id();
            $table->integer('id_worker');
            $table->string('content');
            $table->string('member_read')->comment('ID of user read')->nullable();
            $table->tinyInteger('flag_status')->default('0');
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
        Schema::dropIfExists('need_works');
    }
}
