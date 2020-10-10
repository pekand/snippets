<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTable2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('table2')) {
            return;
        }
        
        Schema::disableForeignKeyConstraints();

        Schema::table('table2', function (Blueprint $table) {

            /* modiy table example */

            $table->string('name');

            $table->index(['id', 'name']);

            $table->renameColumn('user_id', 'owner_id');

            $table->dropForeign(['table1_id']);
            $table->dropColumn(['table1_id']);

            
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

        if (!Schema::hasColumn('table2', 'name')) {
            return;
        }

        Schema::disableForeignKeyConstraints();

        Schema::table('table2', function (Blueprint $table) {
            //$table->dropPrimary('id');
            $table->dropColumn(['name']);
            $table->dropIndex(['id', 'name']);
            //$table->renameIndex('from', 'to');

            $table->renameColumn('owner_id', 'user_id');

            $table->unsignedBigInteger('table1_id');
            $table->foreign('table1_id')
                ->references('id')->on('table1')
                ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }
}
