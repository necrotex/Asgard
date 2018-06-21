<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationFormQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_form_question_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('application_id');
            $table->integer('question_id');
            $table->text('question');
            $table->text('answer')->nullable();
            $table->integer('version')->default(1);
            $table->timestamps();
        });

        Schema::table('application_form_question_answers', function (Blueprint $table) {
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
        Schema::dropIfExists('application_form_question_answers');
    }
}
