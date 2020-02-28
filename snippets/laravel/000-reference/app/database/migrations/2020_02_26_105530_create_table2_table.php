<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table2', function (Blueprint $table) {

            /* foreign key example */

            $table->bigIncrements('id');

            $table->unsignedBigInteger('table1_id');
            $table->foreign('table1_id')
                ->references('id')->on('table1')
                ->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

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
        Schema::disableForeignKeyConstraints();
        Schema::drop('table2');
        Schema::dropIfExists('table2');
        Schema::enableForeignKeyConstraints();
    }
}
