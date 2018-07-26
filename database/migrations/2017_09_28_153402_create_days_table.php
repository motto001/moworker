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
            $table->integer('daytype_id')
            ->unsigned();
            $table->foreign('daytype_id')->references('id')->on('daytypes');
            $table->date('datum');
          //  $table->string('name')->nullable(); //lang
          //  $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('days');
    }
}
