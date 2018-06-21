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

            $table->integer('id')->unsigned()->unique();
            $table->string('name');
            $table->string('ticker');
            $table->integer('member_count')->nullable();
            $table->integer('ceo_id')->nullable();
            $table->integer('alliance_id')->nullable();
            $table->text('description')->nullable();
            $table->float('tax_rate')->nullable();
            $table->dateTime('date_founded')->nullable();
            $table->integer('creator_id')->nullable();
            $table->string('url')->nullable();

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
