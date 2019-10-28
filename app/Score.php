<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    function battingPlayers(){
    	return $this->belongsTo('App\Player','batting_player_id','id');
    }
    
    function bowlingPlayers(){
    	return $this->belongsTo('App\Player','batting_player_id','id');
    }
}
