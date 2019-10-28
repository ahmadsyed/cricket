<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
    		['name' => 'Team_A'],['name' => 'Team_B'],['name' => 'Team_C'],['name' => 'Team_D'],['name' => 'Team_E'],['name' => 'Team_F'],['name' => 'Team_G'],['name' => 'Team_H']
    	];
        DB::table('teams')->insert($teams);
    }
}
