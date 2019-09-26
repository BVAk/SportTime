<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Traintrain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traintrain', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trainer_id')->unsigned();
            $table->integer('training_id')->unsigned();
            
            $table->foreign('trainer_id')->references('id')->on('trainers');
            $table->foreign('training_id')->references('id')->on('trainings');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traintrain');
    }
}
