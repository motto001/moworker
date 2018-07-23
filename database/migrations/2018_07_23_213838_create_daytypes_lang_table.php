<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaytypesLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::dropIfExists('daytypes_lang');
    }
}
