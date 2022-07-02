<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkHasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_has', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_cus');
            $table->bigInteger('id_worker');
            $table->bigInteger('id_phu')->default(0);
            $table->string('real_note', 500)->nullable();
            $table->bigInteger('spending_total')->default('0');
            $table->bigInteger('income_total')->default('0');
            $table->string('bill_imag', 500)->nullable();
            $table ->tinyInteger('status_work')->default(0)->comment = ('0: đang làm; 1:Đã làm xong ; 2:Khách Hủy; 3:Khảo sát; 4: Đã Trả ; 5: đã trả');
            $table->string('seri_number')->nullable();
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
        Schema::dropIfExists('work_has');
    }
}
