<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Silber\Bouncer\Database\Ability;

class UpdateAbilitiesTimerboard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Delete abilities update-timer, delete-timer. Should cascade
        Ability::where('name', '=', 'update-timer')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //can't recreate removed rows
    }
}
