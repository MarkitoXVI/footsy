<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FantasyTeam;

class FantasyTeamController extends Controller
{
    /**
     * Display the user's fantasy team with live stats.
     */
    public function index()
{
    $team = \App\Models\FantasyTeam::where('user_id', auth()->id())->first();

    if (!$team) {
        return redirect()->route('fantasy-team.create')->with('error', 'Please create your team first!');
    }

    // Players may be stored as JSON string or array; normalize to array
    $savedPlayers = is_string($team->players)
        ? json_decode($team->players, true)
        : (array) $team->players;

    // Fetch live FPL data
    $bootstrap = Http::timeout(25)
        ->get('https://fantasy.premierleague.com/api/bootstrap-static/')
        ->json();

    $elements = collect($bootstrap['elements'] ?? []);
    $fplTeams = collect($bootstrap['teams'] ?? [])->keyBy('id');

    // Merge saved team with live API data
    $mapped = collect($savedPlayers ?? [])->map(function ($p) use ($elements, $fplTeams) {
        $savedId  = $p['id'] ?? null;
        $savedNm  = $p['name'] ?? null;
        $savedPos = $p['pos'] ?? null;
        $savedTm  = $p['team'] ?? null;
        $savedPr  = (float)($p['price'] ?? 0);

        $match = $elements->first(function ($e) use ($savedId, $savedNm) {
            return ($savedId && ($e['code'] == $savedId || $e['id'] == $savedId))
                || ($savedNm && strcasecmp($e['web_name'], $savedNm) === 0);
        });

        if ($match) {
            $pos = [1 => 'GK', 2 => 'DEF', 3 => 'MID', 4 => 'FWD'][$match['element_type']] ?? $savedPos ?? '-';
            $tm  = $fplTeams[$match['team']] ?? null;

            return (object)[
                'id'            => $match['id'],
                'code'          => $match['code'],
                'web_name'      => $match['web_name'],
                'position'      => $pos,
                'team_short'    => $tm['short_name'] ?? ($savedTm ?? 'UNK'),
                'price'         => ($match['now_cost'] ?? 0) / 10,
                'total_points'  => $match['total_points'] ?? 0,
                'event_points'  => $match['event_points'] ?? 0,
            ];
        }

        return (object)[
            'id'            => $savedId,
            'code'          => $savedId,
            'web_name'      => $savedNm ?? 'Unknown',
            'position'      => $savedPos ?? '-',
            'team_short'    => $savedTm ?? 'UNK',
            'price'         => $savedPr,
            'total_points'  => 0,
            'event_points'  => 0,
        ];
    });

    // Build a 4-4-2 formation
    $grouped = $mapped->groupBy('position');
    $layout  = ['GK' => 1, 'DEF' => 4, 'MID' => 4, 'FWD' => 2];

    $starters = collect();
    foreach ($layout as $pos => $take) {
        $starters = $starters->merge($grouped->get($pos, collect())->take($take));
    }

    // ❌ $mapped->diff($starters) causes the stdClass-to-string error
    // ✅ Filter by IDs instead
    $starterIds = $starters->pluck('id')->filter()->values();
    $bench = $mapped->filter(fn ($p) => !$starterIds->contains($p->id))->values();

    // Team totals
    $teamValue  = $mapped->sum('price');
    $gwPointsXI = $starters->sum('event_points');

    return view('fantasy-team.index', compact(
        'team', 'mapped', 'starters', 'bench', 'teamValue', 'gwPointsXI'
    ));
}


    /**
     * Create a new team (load players from API)
     */
    public function create()
    {
        $response = Http::get('https://fantasy.premierleague.com/api/bootstrap-static/');
        $data = $response->json();

        $players = collect($data['elements']);
        $teams = collect($data['teams'])->keyBy('id');

        $players = $players->map(function ($p) use ($teams) {
            return (object)[
                'id' => $p['id'],
                'code' => $p['code'],
                'web_name' => $p['web_name'],
                'team' => (object)[
                    'short_name' => $teams[$p['team']]['short_name'] ?? 'UNK',
                ],
                'position_label' => match ($p['element_type']) {
                    1 => 'GK',
                    2 => 'DEF',
                    3 => 'MID',
                    4 => 'FWD',
                },
                'price' => $p['now_cost'] / 10,
            ];
        });

        return view('fantasy-team.create', compact('players'));
    }

    /**
     * Store or update the fantasy team.
     */
    public function store(Request $request)
{
    $request->validate([
        'team_name' => 'required|string|max:30',
        'players'   => 'required',
    ]);

    $players = $request->input('players');

    // ✅ Always store as JSON string, no matter what the frontend sends
    if (is_string($players)) {
        // If it's already a JSON string, verify it's valid JSON
        json_decode($players);
        if (json_last_error() !== JSON_ERROR_NONE) {
            // It's just a plain string, wrap it safely
            $players = json_encode([$players]);
        }
    } elseif (is_array($players) || is_object($players)) {
        $players = json_encode($players);
    } else {
        $players = json_encode([]);
    }

    // ✅ Now it's always a string
    FantasyTeam::updateOrCreate(
        ['user_id' => auth()->id()],
        [
            'team_name' => $request->team_name,
            'players'   => $players,
        ]
    );

    return redirect()->route('fantasy-team.index')->with('success', 'Team saved successfully!');
}

}
