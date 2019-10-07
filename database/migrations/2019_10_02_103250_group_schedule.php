<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupshedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('traintrain_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->date('weekday')->format('d');
            
            $table->foreign('traintrain_id')->references('id')->on('trainings');
            $table->foreign('room_id')->references('id')->on('rooms');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('groupshedule');
    }
}
