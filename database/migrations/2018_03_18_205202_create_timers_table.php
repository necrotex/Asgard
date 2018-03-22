<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timers', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('target');
            $table->string('title');
            $table->integer('forGroup')->nullable()->default(null);
            $table->boolean('private')->default(false);
            $table->integer('ownerId')->unsigned();
            $table->string('modifiedBy');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ownerId')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timers');
    }
}
