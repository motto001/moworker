<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::dropIfExists('days_lang');
    }
}
