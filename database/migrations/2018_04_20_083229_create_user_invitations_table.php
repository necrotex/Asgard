<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invite_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('application_id')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });

        Schema::table('user_invitations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('invite_id')->references('id')->on('application_invites')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('application_id')->references('id')->on('applications')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_invitations');
    }
}
