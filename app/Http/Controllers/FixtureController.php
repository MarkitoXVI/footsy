<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\Team;
use Carbon\Carbon;

class FixtureController extends Controller
{
    /**
     * Display a listing of fixtures.
     */
    public function index()
    {
        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])
            ->orderBy('match_date', 'asc')
            ->paginate(20);
            
        $teams = Team::all();
        
        return view('fixtures.index', compact('fixtures', 'teams'));
    }

    /**
     * Display upcoming fixtures.
     */
    public function upcoming()
    {
        $upcomingFixtures = Fixture::with(['homeTeam', 'awayTeam'])
            ->where('match_date', '>=', now())
            ->orderBy('match_date', 'asc')
            ->paginate(10);
            
        return view('fixtures.upcoming', compact('upcomingFixtures'));
    }

    /**
     * Display the specified fixture.
     */
    public function show(Fixture $fixture)
    {
        $fixture->load(['homeTeam', 'awayTeam', 'events']);
        
        // Get previous meetings between these teams
        $previousMeetings = Fixture::where(function($query) use ($fixture) {
            $query->where('home_team_id', $fixture->home_team_id)
                  ->where('away_team_id', $fixture->away_team_id);
        })->orWhere(function($query) use ($fixture) {
            $query->where('home_team_id', $fixture->away_team_id)
                  ->where('away_team_id', $fixture->home_team_id);
        })->where('id', '!=', $fixture->id)
        ->where('match_date', '<', $fixture->match_date)
        ->orderBy('match_date', 'desc')
        ->take(5)
        ->get();
        
        return view('fixtures.show', compact('fixture', 'previousMeetings'));
    }
}