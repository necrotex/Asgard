<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterJournals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_journals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');

            $table->bigInteger('ref_id');
            $table->string('ref_type');
            $table->dateTime('date');

            $table->bigInteger('first_party_id')->nullable();
            $table->string('first_party_type')->nullable();
            $table->bigInteger('second_party_id')->nullable();
            $table->string('second_party_type')->nullable();

            $table->double('amount')->nullable();
            $table->double('balance')->nullable();
            $table->text('reason')->nullable();

            $table->bigInteger('tax_receiver_id')->nullable();
            $table->double('tax')->nullable();

            $table->bigInteger('extra_location_id')->nullable();
            $table->bigInteger('extra_transaction_id')->nullable();
            $table->string('extra_npc_name')->nullable();
            $table->bigInteger('extra_npc_id')->nullable();
            $table->bigInteger('extra_destroyed_ship_type_id')->nullable();
            $table->bigInteger('extra_character_id')->nullable();
            $table->bigInteger('extra_corporation_id')->nullable();
            $table->bigInteger('extra_alliance_id')->nullable();
            $table->bigInteger('extra_job_id')->nullable();
            $table->bigInteger('extra_contract_id')->nullable();
            $table->bigInteger('extra_system_id')->nullable();
            $table->bigInteger('extra_planet_id')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_journals');
    }
}
