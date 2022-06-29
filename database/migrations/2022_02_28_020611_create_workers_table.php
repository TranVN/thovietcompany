<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('worker_name')->nullable();
            $table->string('sort_name')->nullable();
            $table->string('add_woker', 500)->nullable();
            $table->string('phone_ct')->nullable();
            $table->string('phone_cn')->nullable();
            $table->string('folder_path')->nullable();
            $table -> tinyInteger('kind_worker')->default(0);
            $table -> tinyInteger('has_work')->default(0);
            $table -> tinyInteger('status_worker')->default(0)->comment = ('0: Đang làm; 1: Nghỉ Phép;2: Nghỉ luôn ');
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
        Schema::dropIfExists('workers');
    }
}
