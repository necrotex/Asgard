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
            $table->unsignedBigInteger('id');
            $table->unsignedInteger('corporation_id');
            $table->unsignedInteger('character_id');
            $table->text('name');
            $table->text('ticker');

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
        Schema::dropIfExists('character_corporation');
    }
}
