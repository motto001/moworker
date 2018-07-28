<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
class CreateWorkersTable extends Migration
{
   // use SoftDeletes;
  //  protected $dates = ['deleted_at'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  Not complet in demo
         */
        Schema::create('workers', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('fullname');
            $table->integer('pub')->default(0);       
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
        Schema::table('workers', function(Blueprint $table){
            $table->dropForeign(['user_id']);   
        });
        Schema::drop('workers');
    }
}
