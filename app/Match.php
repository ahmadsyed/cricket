<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    function battingTeams(){
    	return $this->belongsTo('App\Team','batting_team_1','id');
    }
    function bowlingTeams(){
    	return $this->belongsTo('App\Team','bowling_team_1','id');
    }
}
