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
            $table->unsignedBigInteger('item_id');
            $table->unsignedInteger('character_id');
            $table->unsignedBigInteger('location_id');
            $table->enum('location_type',['station', 'solar_system', 'other']);
            $table->string('location_name')->nullable();
            $table->string('location_flag');
            $table->boolean('is_singleton');
            $table->unsignedBigInteger('type_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('related_asset')->nullable();
            $table->string('name')->nullable();

            $table->primary(['item_id', 'character_id']);
            $table->index('type_id');
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
