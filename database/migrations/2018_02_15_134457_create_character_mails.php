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
            $table->integer('character_id')->unsigned();
            $table->integer('mail_id')->unsigned();
            $table->text('subject')->nullable();
            $table->longText('content')->nullable();
            $table->text('sender_name')->nullable();
            $table->text('sender_type')->nullable();
            $table->integer('sender_id')->nullable();
            $table->dateTime('date')->nullable();
        });

        Schema::table('character_mails', function (Blueprint $table) {
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
        Schema::dropIfExists('character_mails');
    }
}
