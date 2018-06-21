<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationFormQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_form_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('application_form_id');
            $table->text('question');
            $table->boolean('required');
            $table->text('description');
            $table->integer('order');
            $table->timestamps();
        });

        Schema::table('application_form_questions', function (Blueprint $table) {
            $table->foreign('application_form_id')->references('id')->on('application_forms')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_form_questions');
    }
}
