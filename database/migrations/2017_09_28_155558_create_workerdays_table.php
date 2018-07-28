<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkerdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workerdays', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('worker_id')->unsigned();
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->integer('daytype_id')->unsigned();
            $table->foreign('daytype_id')->references('id')->on('daytypes');
            $table->date('datum');
        //if havent lang table-------------
            // $table->string('managernote')->nullable();
            // $table->string('workernote')->nullable();
            $table->timestamps();
            $table->integer('pub');
        });
        //multilanguge (If need) ----------
        Schema::create('workerdays_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workerday_id')->unsigned();
            $table->foreign('workerday_id')->references('id')->on('workerdays');
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
        Schema::table('workerdays_lang', function(Blueprint $table){
        $table->dropForeign(['workerday_id']);   
    });
        Schema::drop('workerdays');
        Schema::drop('workerdays_lang');
    }
}
