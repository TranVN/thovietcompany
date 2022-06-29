<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldCustusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_custus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('work_content', 500) ;
            $table->string('name_cus', 500)->nullable();
            $table->string('date_book');
            $table->string('warranty_period')->nullable();
            $table->string('add_cus', 500)->nullable();
            $table->string('des_cus')->nullable();
            $table->string('phone_cus');
            $table->string('note_cus', 500)->nullable();
            $table->string('worker_name');
            $table->string('income_total')->nullable();
            $table->string('spending_total')->nullable();
            $table->string('seri_number')->nullable();
            $table->tinyInteger('cus_show')->default(0);
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
        Schema::dropIfExists('old_custus');
    }
}
