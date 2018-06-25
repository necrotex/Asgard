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
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('client_id');
            $table->text('client_name')->nullable();
            $table->enum('client_type', ['character', 'corporation']);
            $table->boolean('is_buy');
            $table->boolean('is_personal');
            $table->unsignedBigInteger('journal_ref_id');
            $table->unsignedBigInteger('location_id');
            $table->text('location_name')->nullable();
            $table->enum('location_type', ['station', 'structure']);
            $table->integer('quantity');
            $table->integer('type_id');
            $table->float('unit_price',17,2);
            $table->timestamp('date')->nullable();
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
