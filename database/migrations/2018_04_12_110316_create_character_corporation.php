<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterCorporation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_corporation', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corporation_id');
            $table->unsignedInteger('character_id');
            $table->text('name');
            $table->text('ticker');
            $table->timestamps();
        });

        Schema::table('character_corporation', function (Blueprint $table) {
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
        Schema::dropIfExists('character_corporation');
    }
}
