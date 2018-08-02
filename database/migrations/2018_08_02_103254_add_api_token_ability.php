<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Silber\Bouncer\Database\Ability;

class AddApiTokenAbility extends Migration
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
                'name' => 'see-api-token',
                'title' => 'See User Api Token'
            ]
        );

        Bouncer::allow('director')->to('see-api-token');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
