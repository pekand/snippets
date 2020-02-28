<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTest1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test1', function (Blueprint $table) {

            /* all columns basic types example */

            /* primary keys */
            $table->bigIncrements('id');
            //$table->tinyIncrements('id');
            //$table->smallIncrements('id');
            //$table->mediumIncrements('id');
            //$table->increments('id')

            $table->uuid('uuid_column')
                ->nullable(true)
                ->comment('my comment');

            $table->boolean('boolean_column')
                ->default(true);

            $table->tinyInteger('tinyInteger_column');
            $table->smallInteger('smallInteger_column');
            $table->integer('integer_column')
                ->unsigned();
            $table->mediumInteger('mediumInteger_column');
            $table->bigInteger('bigInteger_column');

            $table->unsignedTinyInteger('unsignedTinyInteger_column');
            $table->unsignedMediumInteger('unsignedMediumInteger_column');
            $table->unsignedInteger('unsignedInteger_column');
            $table->unsignedSmallInteger('unsignedSmallInteger_column');
            $table->unsignedBigInteger('unsignedBigInteger_column');

            $table->float('float_column', 8, 2);
            $table->double('double_column', 8, 2);
            $table->decimal('decimal_column', 8, 2);
            $table->unsignedDecimal('unsignedDecimal_column', 8, 2);

            $table->char('char_100_column', 100);
            $table->string('string_100_column', 100);
            $table->lineString('lineString_column');
            $table->multiLineString('multiLineString_column');

            $table->text('text_column')
                ->charset('utf8')
                ->collation('utf8_unicode_ci');

            $table->mediumText('mediumText_column');
            $table->longText('longText_column');

            $table->date('date_column');
            $table->dateTime('dateTime_column', 0);
            $table->dateTimeTz('dateTimeTz_column', 0);
            $table->year('year_column');

            $table->time('time_column', 0);
            $table->timeTz('timeTz_column', 0);
            $table->timestamp('timestamp_column', 0)
                ->useCurrent();
            $table->timestampTz('timestampTz_column', 0)
                ->nullable(true);

            $table->enum('enum_column', ['option1', 'option2']);
            $table->set('set_column', ['option1', 'option2']);

            $table->binary('binary_column');

            $table->json('json_column');
            $table->jsonb('jsonb_column');

            $table->softDeletes();
            //$table->softDeletesTz();
            $table->rememberToken();
            $table->timestamps();
            //$table->nullableTimestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test1');
    }
}
