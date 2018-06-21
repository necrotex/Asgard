<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');
            $table->float('standing');
            $table->string('contact_type');
            $table->integer('contact_id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::table('character_contacts', function (Blueprint $table) {
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
        Schema::dropIfExists('character_contacts');
    }
}
