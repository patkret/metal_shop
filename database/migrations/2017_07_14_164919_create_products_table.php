<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('old_id')->nullable();//store old id
            $table->string('code');
            $table->text('name');
            $table->string('unit');
            $table->float('weight');
            $table->text('desc_short')->nullable();
            $table->text('desc_long')->nullable();
            $table->boolean('visible');
            $table->string('photo_1')->nullable();
            $table->string('photo_2')->nullable();
            $table->float('stock_10');
            $table->float('stock_20');
            $table->float('stock_30');
            $table->boolean('show_missing');
            $table->float('wh_price');
            $table->float('ret_price');
            $table->string('price_basis');
            $table->float('avg_buy_price');
            $table->decimal('custom_margin', 4, 2)->nullable(); //percentage, custom margin on avg_buy_price,
            $table->boolean('value_discount');
            $table->integer('vd_target');
            $table->boolean('amount_discount');
            $table->integer('ad_target');
            $table->boolean('amount_discount_2');
            $table->integer('ad_target_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
