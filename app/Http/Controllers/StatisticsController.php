<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        // Example aggregate team stats (if you have fantasy_teams + fantasy_team_players)
        $team = $user?->fantasyTeam;
        $players = $team?->players()->with('team')->get() ?? collect();

        // Compute summary
        $totalPoints = $players->sum('total_points');
        $totalGoals  = $players->sum('goals_scored');
        $totalAssists= $players->sum('assists');
        $avgForm     = $players->avg('form');
        $teamValue   = $players->sum('price');

        // Global top 5 players (for context)
        $topPlayers = \App\Models\Player::orderByDesc('total_points')->take(5)->get();

        return view('statistics.index', compact(
            'user', 'team', 'players', 'totalPoints', 'totalGoals', 'totalAssists', 'avgForm', 'teamValue', 'topPlayers'
        ));
    }

    public function players(Request $request)
{
    $query = \App\Models\Player::with('team');

    // Filters
    if ($request->filled('position')) {
        $query->where('position_label', $request->position);
    }

    if ($request->filled('team_id')) {
        $query->where('team_id', $request->team_id);
    }

    if ($request->filled('search')) {
        $query->where('web_name', 'like', "%{$request->search}%");
    }

    // Sorting
    if ($request->filled('sort') && $request->filled('direction')) {
        $query->orderBy($request->sort, $request->direction);
    } else {
        $query->orderByDesc('total_points');
    }

    // For AJAX (live filtering)
    if ($request->ajax()) {
        return response()->json([
            'players' => $query->take(200)->get(), // top 200 players for speed
        ]);
    }

    // Normal page load
    $players = $query->take(200)->get();
    $teams = \App\Models\Team::orderBy('name')->get();
    $topPlayers = \App\Models\Player::orderByDesc('total_points')->take(5)->get();

    return view('statistics.players', compact('players', 'teams', 'topPlayers'));
}


    public function teams()
    {
        // Team overview data (average points, goals, etc.)
        $teams = Team::withCount(['players as total_goals' => function ($q) {
                $q->select(\DB::raw('sum(goals_scored)'));
            }])
            ->withCount(['players as total_points' => function ($q) {
                $q->select(\DB::raw('sum(total_points)'));
            }])
            ->orderByDesc('total_points')
            ->get();

        return view('statistics.teams', compact('teams'));
    }

    // Optional JSON (handy for autocomplete/search later)
    public function playersJson(Request $request)
    {
        $q = $request->string('q')->toString();

        $players = Player::with('team')
            ->when($q, function ($query) use ($q) {
                $query->where(function($w) use ($q) {
                    $w->where('first_name', 'like', "%{$q}%")
                      ->orWhere('second_name', 'like', "%{$q}%")
                      ->orWhere('web_name', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('total_points')
            ->limit(25)
            ->get([
                'id','first_name','second_name','web_name','team_id','price',
                'total_points','goals_scored','assists','minutes','element_type'
            ]);

        return response()->json($players);
    }
}
