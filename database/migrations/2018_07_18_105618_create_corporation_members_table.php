<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporation_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('corporation_id');
        });

        Schema::table('corporation_members', function (Blueprint $table) {
            $table->foreign('corporation_id')->references('id')->on('corporations')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporation_members');
    }
}
