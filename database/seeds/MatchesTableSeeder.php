<?php

use Illuminate\Database\Seeder;
use App\{Team,Player};

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
    	$batting_counter = 0;
    	$bowlling_counter = 9;
    	$matches_array = []; 
    	for($match_count=1;$match_count<=4;$match_count++){
            $bat = ++$batting_counter;
            $ball = --$bowlling_counter;
    		array_push($matches_array, ['batting_team_1' => $bat, 'bowling_team_2' => $ball ,'batting_team_2' => $ball, 'bowling_team_1' => $bat , 'batting_player_id'=>$batting_counter*11, 'bowling_player_id' => $bowlling_counter*11]);
    	}
        DB::table('matches')->insert($matches_array);
    }
}
