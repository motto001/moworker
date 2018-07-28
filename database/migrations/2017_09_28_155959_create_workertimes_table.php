<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workertimes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('days');
            $table->integer('timetype_id')->unsigned();
            $table->foreign('timetype_id')->references('id')->on('timetypes');
            $table->time('start');
            $table->time('end')->nullable();
            $table->integer('hour');
        //if havent lang table-------------
            // $table->string('managernote')->nullable();
            //$table->string('workernote')->nullable();
            $table->timestamps();
        });
        //multilanguge (If need) ----------
        Schema::create('workertimes_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workertime_id')->unsigned();
            $table->foreign('workertime_id')->references('id')->on('workertimes');
            $table->string('lang')->default('en');
            $table->string('managernote')->nullable();
            $table->string('workernote')->nullable();
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
        Schema::table('workertimes_lang', function(Blueprint $table){
            $table->dropForeign(['workertime_id']);   
        });
        Schema::drop('workertimes');
        Schema::drop('workertimes_lang');
    }
}
