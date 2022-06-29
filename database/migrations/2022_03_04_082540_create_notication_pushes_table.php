<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticationPushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notication_pushes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_wrote')->comment = ('0: from-app hoặc id');
            $table->string('noti_content');
            $table->string('push_place');
            $table->integer('flag_status')->default(0);
            $table->integer('status_read')->default(0);
            $table->string('members_read')->default('Chưa xem');
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
        Schema::dropIfExists('notication_pushes');
    }
}
