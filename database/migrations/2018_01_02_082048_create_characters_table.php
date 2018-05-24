<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();

            // this can't be a foreign key b/c not all corps are save into the system
            $table->integer('corporation_id')->unsigned();
            $table->text('refresh_token');
            $table->integer('id')->primary();
            $table->text('name');
            $table->text('owner_hash');
            $table->boolean('active')->default(false);
            $table->boolean('ready')->default(false);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');

    }
}
