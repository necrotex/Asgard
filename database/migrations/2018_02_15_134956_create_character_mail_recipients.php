<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterMailRecipients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_mail_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mail_id')->unsigned();
            $table->string('type');
            $table->string('recipient_id');
            $table->string('recipient_name');
        });

        /*@todo: figure out why this doesn't work
        Schema::table('character_mail_recipients', function (Blueprint $table) {
            $table->foreign('mail_id')->references('mail_id')->on('character_mails')->onUpdate('cascade')->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_mail_recipients');
    }
}
