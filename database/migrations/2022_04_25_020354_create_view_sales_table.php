<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_sales', function (Blueprint $table) {
            $table->id();
            $table->longText('content_view_sale')->nullable();
            $table->string('sale_percent')->nullable();
            $table->string('time_begin');
            $table->string('time_end');
            $table->string('image_path')->nullable();
            $table ->tinyInteger('flag')->default('1');
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
        Schema::dropIfExists('view_sales');
    }
}
