<?php

use Illuminate\Database\Seeder;
use App\Player;

class ScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$scores = [];
    	$PlayersModel = Player::all();
    	$counter=0;
    	foreach ($PlayersModel as $k) {

    		$counter++;
    		if($counter<=22){
    			$match_id = 1;
    		}elseif ($counter<=44) {
    			$match_id = 2;
    		}
    		elseif ($counter<=66) {
    			$match_id = 3;
    		}
    		else {
    			$match_id = 4;
    		}
    		//as any player can play as batsman or bowling
    		array_push($scores, ['match_id'=>$match_id,'batting_player_id'=>$k->id,'bowling_player_id'=>$k->id]);
    	}
        DB::table('scores')->insert($scores);
    }
}
