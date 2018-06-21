<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corporation_id');
            $table->text('name');
            $table->longText('description');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('application_forms', function (Blueprint $table) {
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
        Schema::dropIfExists('application_forms');
    }
}
