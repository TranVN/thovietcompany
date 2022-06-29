<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name_cus', 500)->nullable();
            $table->String('date_book');
            $table->String('work_content', 500);
            $table->String('work_note', 500)->nullable();
            $table->String('street', 500)->nullable();
            $table->String('district');
            $table->String('phone_number');
            $table->string('members_read')->default('Chưa xem');
            $table->tinyInteger('kind_work')->default('0');
            $table->tinyInteger('status_cus')->default('0')->comment =('0: Chưa Phân; 1: Đã Phân;2: Khách Hủy ');
            $table->tinyInteger('from_cus')->default('0');
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
        Schema::dropIfExists('works');
    }
}
