<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTes2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test2', function (Blueprint $table) {

            /* foreign key example */

            $table->bigIncrements('id');

            $table->unsignedBigInteger('test1_id');
            $table->foreign('test1_id')
                ->references('id')->on('test1')
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
        Schema::drop('test2');
        Schema::dropIfExists('test2');
        Schema::enableForeignKeyConstraints();
    }
}
