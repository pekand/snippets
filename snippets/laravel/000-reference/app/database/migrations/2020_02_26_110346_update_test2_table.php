<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTest2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('test2')) {
            return;
        }

        Schema::disableForeignKeyConstraints();

        Schema::table('test2', function (Blueprint $table) {
            $table->string('name');

            $table->index(['id', 'name']);

            $table->renameColumn('user_id', 'owner_id');

            $table->dropForeign(['test1_id']);
            $table->dropColumn(['test1_id']);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (!Schema::hasColumn('test2', 'name')) {
            return;
        }

        Schema::table('test2', function (Blueprint $table) {
            //$table->dropPrimary('id');
            $table->dropColumn(['name']);
            $table->dropIndex(['id', 'name']);
            //$table->renameIndex('from', 'to');

            $table->renameColumn('owner_id', 'user_id');

            $table->unsignedBigInteger('test1_id');
            $table->foreign('test1_id')
                ->references('id')->on('test1')
                ->onDelete('cascade');
        });
    }
}
