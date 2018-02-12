<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_corporation_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corporation_id');
            $table->unsignedInteger('character_id');
            $table->dateTime('start_date');
            $table->integer('record_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporation_histories');
    }
}
