<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('tokens', function (Blueprint $table) {
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
        });
        */

        Schema::table('characters', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('corporation_id')->references('id')->on('corporation')->onDelete('cascade');
        });


    }

}
