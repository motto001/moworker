<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetypesLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetypes_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timetype_id')->unsigned();
            $table->foreign('timetype_id')->references('id')->on('timetypes');
            $table->string('lang')->default('en');
            $table->string('name');
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetypes_lang');
    }
}
