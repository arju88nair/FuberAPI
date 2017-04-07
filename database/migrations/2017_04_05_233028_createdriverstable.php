<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createdriverstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('drivers', function (Blueprint $table) {
          $table->increments('id');
          $table->string('regNum');
          $table->string('lat');
          $table->string('lon');
          $table->string('status');
          $table->string('vehType');          
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
        Schema::drop('drivers');
    }
}
