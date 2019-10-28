<?php

use Illuminate\Database\Seeder;

class TournamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$rounds = [['round' => 'first_round'],['round' => 'second_round'],['round' => 'final_round']];
        DB::table('tournaments')->insert($rounds);
    }
}
