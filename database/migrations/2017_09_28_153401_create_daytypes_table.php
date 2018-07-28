<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDaytypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daytypes', function(Blueprint $table) {
            $table->increments('id');
            //$table->string('name');  //lang
            $table->decimal('szorzo',4,2)->default(1);
            $table->integer('fixplusz')->default(0);
          $table->boolean('workday')->default(0);
        //if havent lang table-------------
            //$table->string('name');
            //$table->string('note')->nullable();
        });
          //multilanguge (If need) ----------
        Schema::create('daytypes_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('daytype_id')->unsigned();
            $table->foreign('daytype_id')->references('id')->on('daytypes');
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
        Schema::table('daytypes_lang', function(Blueprint $table){
            $table->dropForeign(['daytype_id']);   
        });
        Schema::drop('daytypes_lang');
        Schema::drop('daytypes');
    }
}
