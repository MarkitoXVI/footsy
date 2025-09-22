<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $teams = [
        ['name' => 'Arsenal', 'short_name' => 'ARS'],
        ['name' => 'Chelsea', 'short_name' => 'CHE'],
        // Add more teams...
    ];
    
    foreach ($teams as $team) {
        Team::create($team);
    }
}

}
