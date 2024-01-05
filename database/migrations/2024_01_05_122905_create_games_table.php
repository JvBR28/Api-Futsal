<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('game_start');
            $table->time('game_end');
            $table->unsignedBigInteger('house_team_id');
            $table->unsignedBigInteger('guest_team_id');
            $table->unsignedBigInteger('score_house_team')->default(0);
            $table->unsignedBigInteger('score_guest_team')->default(0);
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
        Schema::dropIfExists('games');
    }
}
