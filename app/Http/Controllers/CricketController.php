<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Score,Team,Player,Match};
use Exception;
use Response;
use DB;

class CricketController extends Controller
{
	//to Show all matches
    public function getAllMatches(){
    	return Match::with('battingTeams','bowlingTeams')->get();
    }

    //get match details via match Id
    private function getMatchDetails($id){
    	return Match::where('id',$id)->first()->toArray();
    }

    //to switch batman on out,or runs
    private function changeBatman($active_batman, $is_out=false){
    	$team_id = $this->getTeamId($active_batman);
    	$next_player = Player::where(['is_out'=>0,'team_id'=>$team_id])->where('id','!=',$active_batman)->first()->id;
    	Match::where('batting_player_id',$active_batman)->update(['batting_player_id'=>$next_player]);
    	if($is_out){
    		Player::where('id',$active_batman)->update(['is_out'=>1]);
    	}
    }

    //to switch on every 6th valid ball
    private function changeBowler($active_bowler){
    	$team_id = $this->getTeamId($active_bowler);
    	$next_player = Player::where(['team_id'=>$team_id])->where('id','!=',$active_bowler)->first()->id;
    	Match::where('bowling_player_id',$active_bowler)->update(['bowling_player_id'=>$next_player]);
    }

    //to change inning on 120 balls
    private function changeInning($active_bowler,$active_batman){
    	Match::where('bowling_player_id',$active_bowler)->update(['batting_player_id'=>$active_bowler,'bowling_player_id'=>$active_batman]);
    }

    //to get team Id by player id
    private function getTeamId($player_id){
    	return Player::where('id',$player_id)->first()->team_id;
    }

    //get players by team ID with names
    private function getPlayersByTeamId($team_id){
    	return Player::where('team_id',$team_id)->pluck('id');
    }
    //update scores regarding currunt ball
    public function updateRecords(Request $request){
    	try{
    		$event = $request->input('event');
	    	$match_id = $request->input('match_id');
	    	$match_details = $this->getMatchDetails($match_id);
	    	$is_bowler_change = $request->input('change_bowler');
	    	$is_inning_change = $request->input('change_inning');

	    	$is_out = $is_wide = $is_noball = $is_dot = $runs = $bowler_dot = 0;
	    	if($event==7){
	    		$is_out = 1;
	    		$batman_ball = 1;
	    	}elseif($event==8){
	    		$is_wide = 1;
	    		$batman_ball = 0;
	    	}elseif ($event==9) {
				$is_noball = 1;
				$batman_ball = 0;    	
			}elseif($event == 0){
				$is_dot = 1;
				$batman_ball = 1;
				$bowler_dot = 1;
				$runs = 0;
			}else{
				$runs = $event;
				$batman_ball = 1;
				$bowler_dot = 0;
			}
			if($event == 4){
				$batman_four = 1;
				$bowler_four = 1;
				$batman_six=1;
				$bowler_six = 0;
			}elseif ($event == 6) {
				$batman_four = 0;
				$batman_six = 1;
				$bowler_six = 1;
				$bowler_four = 0;
			}else{
				$batman_six=0;
				$batman_four=0;
				$bowler_four = 0;
				$bowler_six = 0;
			}
			$batman_values = ['batman_runs'=>DB::raw("batman_runs + $runs"),'batman_balls'=>DB::raw("batman_balls + $batman_ball"),'batman_fours'=>DB::raw("batman_fours + $batman_four"),'batman_sixes'=>DB::raw("batman_sixes + $batman_six")];
			$bowler_values = ['bowler_runs'=>DB::raw("bowler_runs + $runs"),'bowler_zeros'=>DB::raw("bowler_zeros + $bowler_dot"),'bowler_fours'=>DB::raw("bowler_fours + $bowler_four"),'bowler_sixes'=>DB::raw("bowler_sixes + $bowler_six"),'bowler_nos'=>DB::raw("bowler_nos + $is_noball"),'bowler_wides'=>DB::raw("bowler_wides + $is_wide"),'bowler_wicket'=>DB::raw("bowler_wicket + $is_out")];
			$BatScoreModel = Score::where(['batting_player_id'=>$match_details['batting_player_id']])->update($batman_values);
			$bowler_values = Score::where(['bowling_player_id'=>$match_details['bowling_player_id']])->update($bowler_values);
			if($event == 1 || $event == 3 || $event == 7){
				$this->changeBatman($match_details['batting_player_id'],$is_out);
			}
			if($is_bowler_change){
				$this->changeBowler($match_details['bowling_player_id']);
			}
			if($is_inning_change){
				$this->changeInning($match_details['bowling_player_id'],$match_details['batting_player_id']);
			}
			return $batman_values;
    	}catch(Exception $e){
    		return Response::json('somthing went wrong');
    	}
    }
    //get players data
    private function getPlayerScores($batman_ids){
    	return Score::whereIn('batting_player_id',$batman_ids)->with('battingPlayers','bowlingPlayers')->get()->toArray();
    }
    //get formated scores to show on angular page
    public function getScore(Request $request){
    	try{
    		$scores = [];
    		$first_inning = [];
    		$second_inning = [];

    		$match_id = $request->input('id');
    		$match_details = $this->getMatchDetails($match_id);
    		
    		$player_ids = $this->getPlayersByTeamId($match_details['batting_team_1']);
    		$batting_team_1 = $this->getPlayerScores($player_ids);
    		$bowling_team_1 = $this->getPlayerScores($player_ids);

    		$player_ids = $this->getPlayersByTeamId($match_details['batting_team_2']);
    		$batting_team_2 = $this->getPlayerScores($player_ids);
    		$bowling_team_2 = $this->getPlayerScores($player_ids);


    		array_push($first_inning, ["batting_team_1"=>$batting_team_1],['bowling_team_2'=>$bowling_team_2]);
    		array_push($second_inning, ['batting_team_2'=>$batting_team_2],['bowling_team_1'=>$bowling_team_1]);
    		array_push($scores,['first_inning'=>$first_inning],['second_inning'=>$second_inning]);

    		return Response::json($scores);
    	}catch(Exception $e){
    		return Response::json($e);
    	}
    }
}
