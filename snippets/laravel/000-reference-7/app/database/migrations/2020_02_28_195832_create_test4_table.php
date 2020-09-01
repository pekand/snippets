<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTest4Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test4', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('status')->default("New");

            $table->unsignedBigInteger('owner_id')
                ->nullable();
            $table->foreign('owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('test3_id')
                ->nullable();
            $table->foreign('test3_id')
                ->references('id')->on('test3')
                ->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('test4');
    }
}
