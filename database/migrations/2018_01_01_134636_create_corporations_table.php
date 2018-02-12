<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporations', function (Blueprint $table) {

            $table->integer('id')->unique();
            $table->string('name');
            $table->string('ticker');
            $table->integer('member_count');
            $table->integer('ceo_id');
            $table->integer('alliance_id')->nullable();
            $table->text('description');
            $table->float('tax_rate');
            $table->dateTime('date_founded');
            $table->integer('creator_id');
            $table->string('url');

            $table->boolean('active')->default(false);

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
        Schema::dropIfExists('corporations');
    }
}
