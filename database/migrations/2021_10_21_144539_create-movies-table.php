<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    const TABLE_NAME = 'data_movies';
    const STRING_FIELD_LENGTH = 50;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(
                self::TABLE_NAME,
                function (Blueprint $table) {
                    //columns
                    $table->increments('id');
                    $table->string('name', self::STRING_FIELD_LENGTH)->nullable(false);
                    $table->enum('format', ['VHS', 'DVD', 'Streaming']);
                    $table->time('length');
                    $table->integer('release_year');
                    $table->integer('rating');
                });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable(self::TABLE_NAME)) {
            Schema::drop(SELF::TABLE_NAME);
        }
    }
}
