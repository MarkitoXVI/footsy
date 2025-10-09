<?php

namespace App\Http\Controllers;

use App\Models\FantasyTeam;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FantasyTeamController extends Controller
{
    /**
     * Parāda resursa sarakstu.
     */
    public function index()
    {
        $user = Auth::user();
        $fantasyTeam = FantasyTeam::where('user_id', $user->id)
            ->with(['players.team']) // Eager load players and their teams
            ->first();

        return view('fantasy-team.index', compact('fantasyTeam'));
    }

    /**
     * Parāda formu jauna resursa izveidei.
     */
    public function create()
{
    $players = \App\Models\Player::with('team')
        ->orderByDesc('total_points')
        ->get();

    $teams = \App\Models\Team::orderBy('name')->get();

    return view('fantasy-team.create', compact('players', 'teams'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'players' => 'required|string'
    ]);

    $playerIds = explode(',', $request->players);
    if (count($playerIds) > 15) {
        return back()->withErrors('You can only select up to 15 players.');
    }

    // Save team (simplified)
    $team = \App\Models\FantasyTeam::create([
        'user_id' => auth()->id(),
        'name' => 'My Team',
        'budget_spent' => \App\Models\Player::whereIn('id', $playerIds)->sum('price'),
    ]);

    $team->players()->attach($playerIds);

    return redirect()->route('fantasy-team.index')->with('success', 'Team created successfully!');
}



  public function edit($id)
{
    $fantasyTeam = FantasyTeam::with('players')->findOrFail($id);

    // all available players (to show in modal for substitutions)
    $players = Player::all();

    // build structured teamData to preload JS
    $formation = explode('-', $fantasyTeam->formation);
    $defendersCount = (int)$formation[0];
    $midfieldersCount = (int)$formation[1];
    $forwardsCount = (int)$formation[2];

    $starting = $fantasyTeam->players->where('pivot.is_substitute', false)->sortBy('pivot.position_order');
    $subs = $fantasyTeam->players->where('pivot.is_substitute', true)->sortBy('pivot.position_order');

    $teamData = [
        'total_budget'   => $fantasyTeam->total_budget,
        'spent_budget'   => $fantasyTeam->spent_budget,
        'remaining_budget' => $fantasyTeam->remaining_budget,
        'formation'      => $fantasyTeam->formation,
        'gk'             => $starting->where('position', 'Goalkeeper')->values()->map->only(['id','name','team','position','price']),
        'defenders'      => $starting->where('position', 'Defender')->take($defendersCount)->values()->map->only(['id','name','team','position','price']),
        'midfielders'    => $starting->where('position', 'Midfielder')->take($midfieldersCount)->values()->map->only(['id','name','team','position','price']),
        'forwards'       => $starting->where('position', 'Forward')->take($forwardsCount)->values()->map->only(['id','name','team','position','price']),
        'subs'           => $subs->values()->map->only(['id','name','team','position','price']),
    ];

    return view('fantasy-team.edit', compact('fantasyTeam', 'players', 'teamData'));
}

}