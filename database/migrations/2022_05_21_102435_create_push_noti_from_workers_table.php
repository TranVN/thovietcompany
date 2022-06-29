<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushNotiFromWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_noti_from_workers', function (Blueprint $table) {
            $table->id();
            $table -> integer('id_worker');
            $table-> integer('id_work_has');
            $table->integer('member_read');
            $table ->tinyInteger('flag')->define('0-> chưa đọc; 1 đã đọc');
            $table->tinyInteger('content_push')->define('1-> trả lịch;2-> Đã Khảo sát; 3->khách hủy lịch;4 ->khách hẹn lại');
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
        Schema::dropIfExists('push_noti_from_workers');
    }
}
