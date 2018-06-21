<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterFatigue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_fatigue', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('last_jump_date')->nullable();
            $table->dateTime('jump_fatigue_expire_date')->nullable();
            $table->dateTime('last_update_date')->nullable();
            $table->unsignedInteger('character_id');
            $table->timestamps();
        });

        Schema::table('character_fatigue', function (Blueprint $table) {
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
        Schema::dropIfExists('character_fatigue');
    }
}
