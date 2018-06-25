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
            $table->unsignedBigInteger('ref_id');
            $table->string('ref_type');
            $table->unsignedBigInteger('context_id')->nullable();
            $table->enum('context_type', [
                'structure_id', 'station_id', 'market_transaction_id', 'character_id', 'corporation_id', 'alliance_id', 'eve_system', 'industry_job_id', 'contract_id', 'planet_id', 'system_id', 'type_id'
            ])->nullable();
            $table->text('description');
            $table->dateTime('date')->nullable();
            $table->string('reason')->nullable();
            $table->unsignedBigInteger('first_party_id')->nullable();
            $table->string('first_party_type')->nullable();
            $table->unsignedBigInteger('second_party_id')->nullable();
            $table->string('second_party_type')->nullable();
            $table->float('amount', 17, 2)->nullable();
            $table->float('balance', 17, 2)->nullable();
            $table->float('tax', 17, 2)->nullable();
            $table->unsignedBigInteger('tax_receiver_id')->nullable();

            $table->timestamps();

        });

        Schema::table('character_journals', function (Blueprint $table) {
            $table->foreign('character_id')->references('id')->on('characters')->onUpdate('cascade')->onDelete('cascade');
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
