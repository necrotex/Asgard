<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Silber\Bouncer\Database\Ability;

class AddSystemlogAbility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Ability::create(
            [
                'name' => 'view-full-systemlog',
                'title' => 'View full Systemlog'
            ]
        );

        Ability::create(
            [
                'name' => 'view-recruitment-systemlog',
                'title' => 'View recruitment Systemlog'
            ]
        );

        Bouncer::allow('director')->to('view-full-systemlog');
        Bouncer::allow('recruiter')->to('view-recruitment-systemlog');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
