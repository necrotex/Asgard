<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscordUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discord_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->integer('user_id')->unisigned();

            $table->text('nickname');
            $table->text('avatar_url')->nullable();
            $table->text('refresh_token');

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
        Schema::dropIfExists('discord_users');
    }
}
