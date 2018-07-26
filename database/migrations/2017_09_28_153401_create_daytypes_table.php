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
         //   $table->string('note')->nullable();
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('daytypes');
    }
}
