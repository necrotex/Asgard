<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterMails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');

            $table->integer('mail_id')->nullable();
            $table->text('subject')->nullable();
            $table->longText('content')->nullable();

            $table->text('sender_name')->nullable();
            $table->integer('sender_id')->nullable();
            $table->dateTime('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_mails');
    }
}
