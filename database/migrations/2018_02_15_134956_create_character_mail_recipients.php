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
            $table->unsignedInteger('mail_id');

            $table->string('type');
            $table->string('recipient_id');
            $table->string('recipient_name');
        });
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
