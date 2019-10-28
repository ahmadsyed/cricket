<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('batting_team_1')->unsigned();
            $table->integer('bowling_team_2')->unsigned();
            $table->integer('batting_team_2')->unsigned();
            $table->integer('bowling_team_1')->unsigned();
            $table->integer('batting_player_id')->unsigned();
            $table->integer('bowling_player_id')->unsigned();
            $table->foreign('batting_team_1')
              ->references('id')->on('teams')
              ->onDelete('cascade');
            $table->foreign('bowling_team_2')
              ->references('id')->on('teams')
              ->onDelete('cascade');
              $table->foreign('batting_team_2')
              ->references('id')->on('teams')
              ->onDelete('cascade');
            $table->foreign('bowling_team_1')
              ->references('id')->on('teams')
              ->onDelete('cascade');
            $table->foreign('batting_player_id')
              ->references('id')->on('players')
              ->onDelete('cascade');
              $table->foreign('bowling_player_id')
              ->references('id')->on('players')
              ->onDelete('cascade');
            $table->integer('team_1_total_runs')->nullable()->default(0);
            $table->integer('team_2_total_runs')->nullable()->default(0);
            $table->integer('team_1_total_balls')->nullable()->default(0);
            $table->integer('team_2_total_balls')->nullable()->default(0);
            $table->integer('team_1_total_wkt')->nullable()->default(0);
            $table->integer('team_2_total_wkt')->nullable()->default(0);
            $table->integer('winning_team')->nullable();
            $table->boolean('is_completed')->nullable(false)->default(0);
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
        Schema::dropIfExists('matches');
    }
}
