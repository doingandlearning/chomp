<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date');
            $table->integer('season_id')->unsigned()->nullable();
            $table->foreign('season_id')->references('id')->on('seasons');
            $table->integer('venue_id')->unsigned()->nullable();
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->integer('leader_id')->unsigned()->nullable();
            $table->foreign('leader_id')->references('id')->on('leaders');
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
        Schema::dropIfExists('sessions');
    }
}
