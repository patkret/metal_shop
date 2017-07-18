<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->integer('id');
            $table->string('code');
            $table->text('name');
            $table->string('unit');
            $table->float('wh_price');
            $table->float('ret_price');
            $table->float('avg_price');
            $table->float('stock_10');
            $table->float('stock_20');
            $table->float('manual');
            $table->float('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
}
