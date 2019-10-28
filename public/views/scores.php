<div ng-init = "getScore(match_id)">
<h2>First Inning</h2>
<table>
	<thead>
		<td>Batsman</td>
		<td>Runs</td>
		<td>Balls</td>
		<td>4s</td>
		<td>6s</td>
		<td>Strik Rate</td>
	</thead>
	<tbody>
		<tr ng-repeat="batman in first_inning_batting">
			<td>{{batman.batting_players.name}}</td>
			<td>{{batman.batman_runs}}</td>
			<td>{{batman.batman_balls}}</td>
			<td>{{batman.batman_fours}}</td>
			<td>{{batman.batman_sixes}}</td>
			<td>{{batman.batman_runs*100/batman.batman_balls}}</td>
		</tr>
	</tbody>
</table>
<h3>Bowler</h3>
<table>
	<thead>
		<tr>
			<td>Name</td>
			<td>Balls</td>
			<td>Runs</td>
			<td>Wickets</td>
			<td>Econ</td>
			<td>0s</td>
			<td>4s</td>
			<td>6s</td>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat = "bowler in first_inning_bowling">
			<td>{{bowler.bowling_players.name}}</td>
			<td>{{bowler.bowler_balls}}</td>
			<td>{{bowler.bowler_runs}}</td>
			<td>{{bowler.bowler_wicket}}</td>
			<td>{{bowler.bowler_runs/6}}</td>
			<td>{{bowler.bowler_zeros}}</td>
			<td>{{bowler.bowler_fours}}</td>
			<td>{{bowler.bowler_sixes}}</td>
		</tr>
	</tbody>
</table>


<h2>Second Inning</h2>
<table>
	<thead>
		<tr>
			<td>Batsman</td>
			<td>Runs</td>
			<td>Balls</td>
			<td>4s</td>
			<td>6s</td>
			<td>Strik Rate</td>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="batman in second_inning_batting">
			<td>{{batman.batting_players.name}}</td>
			<td>{{batman.batman_runs}}</td>
			<td>{{batman.batman_balls}}</td>
			<td>{{batman.batman_fours}}</td>
			<td>{{batman.batman_sixes}}</td>
			<td>{{batman.batman_runs*100/batman.batman_balls}}</td>
		</tr>
	</tbody>
</table>
<h3>Bowler</h3>
<table>
	<thead>
		<tr>
			<td>Name</td>
			<td>Balls</td>
			<td>Runs</td>
			<td>Wickets</td>
			<td>Econ</td>
			<td>0s</td>
			<td>4s</td>
			<td>6s</td>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="bowler in second_inning_bowling">
			<td>{{bowler.bowling_players.name}}</td>
			<td>{{bowler.bowler_balls}}</td>
			<td>{{bowler.bowler_runs}}</td>
			<td>{{bowler.bowler_wicket}}</td>
			<td>{{Number(bowler.bowler_runs)/6}}</td>
			<td>{{bowler.bowler_zeros}}</td>
			<td>{{bowler.bowler_fours}}</td>
			<td>{{bowler.bowler_sixes}}</td>
		</tr>
	</tbody>
</table>
</div>