<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createbookingstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('bookings', function (Blueprint $table) {
           $table->increments('id');
           $table->string('uId');
           $table->string('lat');
           $table->string('lon');
           $table->string('type');           
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
         Schema::drop('bookings');
     }
}
