<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaikusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haikus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->text('text');
            $table->unsignedBigInteger('application_id')->nullable();
        });

        Artisan::call('db:seed', ['--class' => HaikuSeeder::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('haikus');
    }
}
