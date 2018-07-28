<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetypes', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('szorzo',4,2)->default(1)->nullable();
        //if havent lang table-------------
            //$table->string('name');
            //$table->string('note')->nullable();
        });
        //multilanguge (If need) ----------
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
       Schema::table('timetypes_lang', function(Blueprint $table){
            $table->dropForeign(['timetype_id']);   
        });
        Schema::drop('timetypes');
        Schema::drop('timetypes_lang');
    }
}
