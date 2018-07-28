<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('daytype_id') ->unsigned();
             $table->foreign('daytype_id')->references('id')->on('daytypes');
            $table->date('datum');
           
         //lang-----------  
           //  $table->string('name')->nullable(); 
           //  $table->string('note')->nullable();
        });
        //multilanguge (If need) ----------
        Schema::create('days_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('days');
            $table->string('lang')->default('en');
            $table->string('name')->nullable(); 
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
        Schema::table('days_lang', function(Blueprint $table){
            $table->dropForeign(['day_id']);   
        });
        Schema::table('days', function(Blueprint $table){
            $table->dropForeign(['daytype_id']);   
        });
        Schema::drop('days');
        Schema::dropIfExists('days_lang');
    }
}
