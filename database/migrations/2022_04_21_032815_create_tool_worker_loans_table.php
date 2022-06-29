<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolWorkerLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_worker_loans', function (Blueprint $table) {
            $table->id();
            $table->longText('content_loan');
            $table->string('name_worker');
            $table->date('date_loan');
            $table->date('date_give_back')->nullable();
            $table->integer('type_loan')->default('0');
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
        Schema::dropIfExists('tool_worker_loans');
    }
}
