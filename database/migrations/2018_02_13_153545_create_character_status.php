<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_status', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');
            $table->boolean('online');
            $table->dateTime('last_login');
            $table->dateTime('last_logout');
            $table->integer('logins');
            $table->timestamps();
        });

        Schema::table('character_status', function (Blueprint $table) {
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
        Schema::dropIfExists('character_status');
    }
}
