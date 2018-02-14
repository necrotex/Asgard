<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');

            $table->integer('skill_id');
            $table->integer('skillpoints_in_skill');
            $table->integer('trained_skill_level');
            $table->integer('active_skill_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_skills');
    }
}
