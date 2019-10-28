<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batting_player_id')->unsigned();
            $table->foreign('batting_player_id')
              ->references('id')->on('players')
              ->onDelete('cascade');
            $table->integer('bowling_player_id')->unsigned();
            $table->foreign('bowling_player_id')
              ->references('id')->on('players')
              ->onDelete('cascade');
            $table->integer('match_id')->unsigned();
            $table->foreign('match_id')
              ->references('id')->on('matches')
              ->onDelete('cascade');
            $table->integer('batman_runs')->nullable()->default(0);
            $table->integer('batman_balls')->nullable()->default(0);
            $table->integer('batman_fours')->nullable()->default(0);
            $table->integer('batman_sixes')->nullable()->default(0);
            $table->integer('bowler_runs')->nullable()->default(0);
            $table->integer('bowler_zeros')->nullable()->default(0);
            $table->integer('bowler_fours')->nullable()->default(0);
            $table->integer('bowler_sixes')->nullable()->default(0);
            $table->integer('bowler_nos')->nullable()->default(0);
            $table->integer('bowler_wides')->nullable()->default(0);
            $table->integer('bowler_maiden')->nullable()->default(0);
            $table->integer('bowler_balls')->nullable()->default(0);
            $table->integer('bowler_wicket')->nullable()->default(0);
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
        Schema::dropIfExists('scores');
    }
}
