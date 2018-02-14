<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterSkillqueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_skillqueue', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');

            $table->integer('skill_id');
            $table->dateTime('finish_date')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->integer('finished_level')->nullable();
            $table->integer('queue_position')->nullable();
            $table->integer('training_start_sp')->nullable();
            $table->integer('level_end_sp')->nullable();
            $table->integer('level_start_sp')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_skillqueue');
    }
}
