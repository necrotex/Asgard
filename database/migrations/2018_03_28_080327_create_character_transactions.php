<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('character_id');
            $table->bigInteger('transaction_id');
            $table->dateTime('date');
            $table->bigInteger('type_id');
            $table->bigInteger('location_id');
            $table->double('unit_price');
            $table->bigInteger('quantity');
            $table->bigInteger('client_id');
            $table->boolean('is_buy');
            $table->boolean('is_personal');
            $table->bigInteger('journal_ref_id');
            $table->timestamps();
        });

        Schema::table('character_transactions', function (Blueprint $table) {
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
        Schema::dropIfExists('character_transactions');
    }
}
