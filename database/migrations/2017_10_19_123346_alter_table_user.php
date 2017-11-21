<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('users', function (Blueprint $table) {
                $table->string('last_name');
                $table->string('first_name');
                $table->string('street');
                $table->string('city');
                $table->string('zip_code');
                $table->integer('number_of_orders')->nullable();
                $table->integer('status');
                $table->text('company_name')->nullable();
                $table->string('nip')->nullable();
                $table->string('phone_no');

            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
