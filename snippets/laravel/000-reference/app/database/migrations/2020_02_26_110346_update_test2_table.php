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
        /*if (!Schema::hasTable('test2')) {
            return;
        }*/

        Schema::table('test2', function (Blueprint $table) {
            $table->string('name');
            $table->renameColumn('user_id', 'owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        /*if (!Schema::hasColumn('test2', 'name')) {
            return;
        }*/

        Schema::table('test2', function (Blueprint $table) {
            $table->dropColumn(['name']);
            $table->renameColumn('owner_id', 'user_id');
        });
    }
}
