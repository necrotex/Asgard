<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');
            $table->string('location_flag');
            $table->double('location_id');
            $table->string('location_type');
            $table->string('location_name')->nullable();
            $table->boolean('is_singleton');
            $table->integer('type_id');
            $table->double('item_id');
            $table->integer('quantity');
            $table->double('related_asset')->nullable();
            $table->string('name')->nullable();
        });

        Schema::table('character_assets', function (Blueprint $table) {
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
        Schema::dropIfExists('character_assets');
    }
}
