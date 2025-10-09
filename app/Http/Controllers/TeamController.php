<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of all teams.
     */
    public function index()
    {
        $teams = \App\Models\Team::withCount('players')->get();
        return view('teams.index', compact('teams'));
    }


    /**
     * Display a single team and its players.
     */
    public function show(Team $team)
    {
        // Load players for this team
        $players = Player::where('team_id', $team->id)
            ->orderBy('position')
            ->orderBy('name')
            ->paginate(25);

        return view('teams.show', compact('team', 'players'));
    }
}
