<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StatisticsController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $team = $user?->fantasyTeam;
    $players = collect();

    // STEP 1: Fetch FPL API data safely
    try {
        $response = Http::timeout(10)->get('https://fantasy.premierleague.com/api/bootstrap-static/');
        $data = $response->json();
        $elements = collect($data['elements'] ?? []);
        $teams = collect($data['teams'] ?? [])->keyBy('id');
    } catch (\Exception $e) {
        // Fallback if API fails
        $elements = collect();
        $teams = collect();
        \Log::warning('FPL API failed: ' . $e->getMessage());
    }

    // STEP 2: Decode the saved team from DB
    if ($team && $team->players) {
        $decoded = is_string($team->players)
            ? json_decode($team->players, true)
            : $team->players;

        if (is_array($decoded)) {
            $players = collect($decoded)->map(function ($saved) use ($elements, $teams) {
                $match = $elements->first(function ($p) use ($saved) {
                    return $p['id'] == ($saved['id'] ?? null) || $p['code'] == ($saved['code'] ?? null);
                });

                // If we found live data
                if ($match) {
                    return (object)[
                        'id' => $match['id'],
                        'name' => $match['web_name'],
                        'team' => $teams[$match['team']]['short_name'] ?? 'UNK',
                        'position' => match ($match['element_type']) {
                            1 => 'GK', 2 => 'DEF', 3 => 'MID', 4 => 'FWD', default => '-'
                        },
                        'price' => $match['now_cost'] / 10,
                        'points' => $match['total_points'] ?? 0,
                        'goals' => $match['goals_scored'] ?? 0,
                        'assists' => $match['assists'] ?? 0,
                        'form' => (float)($match['form'] ?? 0),
                    ];
                }

                // Otherwise use stored data
                return (object)[
                    'id' => $saved['id'] ?? 0,
                    'name' => $saved['web_name'] ?? 'Unknown',
                    'team' => is_array($saved['team'])
                        ? ($saved['team']['short_name'] ?? 'UNK')
                        : ($saved['team'] ?? 'UNK'),
                    'position' => $saved['position_label'] ?? '-',
                    'price' => $saved['price'] ?? 0,
                    'points' => 0,
                    'goals' => 0,
                    'assists' => 0,
                    'form' => 0,
                ];
            });
        }
    }

    // STEP 3: Compute stats
    $totalPoints = $players->sum('points');
    $totalGoals = $players->sum('goals');
    $totalAssists = $players->sum('assists');
    $avgForm = $players->count() ? $players->avg(fn($p) => (float)$p->form) : 0;
    $teamValue = $players->sum('price');

    // STEP 4: Position breakdown (for chart)
    $positionBreakdown = [
        'GK'  => $players->where('position', 'GK')->count(),
        'DEF' => $players->where('position', 'DEF')->count(),
        'MID' => $players->where('position', 'MID')->count(),
        'FWD' => $players->where('position', 'FWD')->count(),
    ];

    // STEP 5: Top 5 players globally (if API worked)
    $topPlayers = collect();
    if ($elements->isNotEmpty()) {
        $topPlayers = $elements
            ->sortByDesc('total_points')
            ->take(5)
            ->map(fn($p) => (object)[
                'name' => $p['web_name'],
                'team' => $teams[$p['team']]['short_name'] ?? 'UNK',
                'points' => $p['total_points'],
                'goals' => $p['goals_scored'],
                'assists' => $p['assists'],
                'price' => $p['now_cost'] / 10,
            ]);
    }

    // STEP 6: Debug info (optional during testing)
    if ($players->isEmpty()) {
        \Log::info('No players found for team: ' . ($team->id ?? 'none'));
    }

    // STEP 7: Render
    return view('statistics.index', compact(
        'user',
        'team',
        'players',
        'totalPoints',
        'totalGoals',
        'totalAssists',
        'avgForm',
        'teamValue',
        'topPlayers',
        'positionBreakdown'
    ));
}


    public function players(Request $request)
    {
        $query = Player::with('team');

        if ($request->filled('position')) {
            $query->where('position_label', $request->position);
        }

        if ($request->filled('team_id')) {
            $query->where('team_id', $request->team_id);
        }

        if ($request->filled('search')) {
            $query->where('web_name', 'like', "%{$request->search}%");
        }

        if ($request->filled('sort') && $request->filled('direction')) {
            $query->orderBy($request->sort, $request->direction);
        } else {
            $query->orderByDesc('total_points');
        }

        if ($request->ajax()) {
            return response()->json([
                'players' => $query->take(200)->get(),
            ]);
        }

        $players = $query->take(200)->get();
        $teams = Team::orderBy('name')->get();
        $topPlayers = Player::orderByDesc('total_points')->take(5)->get();

        return view('statistics.players', compact('players', 'teams', 'topPlayers'));
    }

    public function teams()
    {
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

    public function playersJson(Request $request)
    {
        $q = $request->string('q')->toString();

        $players = Player::with('team')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('first_name', 'like', "%{$q}%")
                        ->orWhere('second_name', 'like', "%{$q}%")
                        ->orWhere('web_name', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('total_points')
            ->limit(25)
            ->get([
                'id',
                'first_name',
                'second_name',
                'web_name',
                'team_id',
                'price',
                'total_points',
                'goals_scored',
                'assists',
                'minutes',
                'element_type',
            ]);

        return response()->json($players);
    }
}
