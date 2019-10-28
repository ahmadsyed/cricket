<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [];
        $counter = 0;
        for($team_count=1;$team_count<=8;$team_count++){
        	for($p_count=1;$p_count<=11;$p_count++){
    			array_push($players, ['name' => 'Player-'.$p_count.'-team-'.$team_count, 'team_id' => $team_count]);
    		}
        }
    	
        DB::table('players')->insert($players);
    }
}
