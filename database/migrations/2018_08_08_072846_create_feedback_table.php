<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Silber\Bouncer\Database\Ability;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('text');
            $table->string('hash');
            $table->timestamps();
        });

        Ability::create(
            [
                'name' => 'create-feedback',
                'title' => 'Use the Feedback Form'
            ]
        );

        Ability::create(
            [
                'name' => 'see-feedback',
                'title' => 'See the Feedback Form'
            ]
        );

        Bouncer::allow('member')->to('create-feedback');
        Bouncer::allow('director')->to('see-feedback');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
