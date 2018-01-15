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
        Schema::create('corporation_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_date');
            $table->integer('corporation_id');
            $table->boolean('is_deleted')->default(false);
            $table->integer('record_id');

            $table->integer('character_id')->unsigned();
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
        Schema::dropIfExists('corporation_histories');
    }
}
