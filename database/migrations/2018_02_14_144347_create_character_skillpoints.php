<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterSkillpoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_skillpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');
            $table->integer('total_sp');
            $table->integer('unallocated_sp')->nullable();
        });

        Schema::table('character_skillpoints', function (Blueprint $table) {
            $table->foreign('character_id')->references('id')->on('characters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_skillpoints');
    }
}
