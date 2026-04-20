<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fixture;
use App\Models\FantasyTeam;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $fantasyTeam = $user->fantasyTeam;

    // User Stats
    $userStats = [
        'has_team'       => (bool) $fantasyTeam,
        'total_points'   => $fantasyTeam?->total_points ?? 0,
        'global_rank'    => $fantasyTeam?->global_rank ?? 'N/A',
        'leagues_joined' => 3,
        'free_transfers' => $fantasyTeam?->free_transfers ?? 2,
    ];

    // === MY ACTUAL TEAM PLAYERS ===
    $myTeamPlayers = collect();

    if ($fantasyTeam && $fantasyTeam->players) {
        $playerIds = is_string($fantasyTeam->players) 
            ? json_decode($fantasyTeam->players, true) 
            : $fantasyTeam->players;

        if (!empty($playerIds)) {
            $bootstrap = \Illuminate\Support\Facades\Http::timeout(15)
                ->get('https://fantasy.premierleague.com/api/bootstrap-static/')
                ->json();

            $elements = collect($bootstrap['elements'] ?? []);
            $teamsData = collect($bootstrap['teams'] ?? [])->keyBy('id');

            $myTeamPlayers = $elements
                ->whereIn('id', $playerIds)
                ->map(function ($p) use ($teamsData) {
                    $team = $teamsData[$p['team']] ?? null;

                    return (object)[
                        'id'          => $p['id'],
                        'web_name'    => $p['web_name'],
                        'team'        => (object)[
                            'name'       => $team['name'] ?? 'Unknown',
                            'short_name' => $team['short_name'] ?? 'UNK',
                        ],
                        'price'       => $p['now_cost'] / 10,
                        'points'      => $p['total_points'],
                        'event_points'=> $p['event_points'] ?? 0,
                    ];
                })
                ->values();
        }
    }

        // Top Games (sample data)
        $topGames = collect([
            (object) [
                'home_team' => (object)['name' => 'Brentford', 'short_name' => 'BRE'],
                'away_team' => (object)['name' => 'Manchester United', 'short_name' => 'MUN'],
                'score_home' => 3,
                'score_away' => 1,
                'scorers_home' => ["Igor Thiago 8'", "Igor Thiago 20'", "Mathias Jensen 90+5'"],
                'scorers_away' => ["Benjamin Šeško 26'"],
                'gameweek' => 6,
            ],
            (object) [
                'home_team' => (object)['name' => 'Chelsea', 'short_name' => 'CHE'],
                'away_team' => (object)['name' => 'Brighton', 'short_name' => 'BHA'],
                'score_home' => 1,
                'score_away' => 3,
                'scorers_home' => ["Enzo Fernández 24'"],
                'scorers_away' => ["Danny Welbeck 77'", "Maxim De Cuyper 90' +2", "Danny Welbeck 90' +10"],
                'gameweek' => 6,
            ],
            (object) [
                'home_team' => (object)['name' => 'Crystal Palace', 'short_name' => 'CRY'],
                'away_team' => (object)['name' => 'Liverpool', 'short_name' => 'LIV'],
                'score_home' => 2,
                'score_away' => 1,
                'scorers_home' => ["Ismaïla Sarr 9'", "Edward Nketiah 90' +7"],
                'scorers_away' => ["Federico Chiesa 87'"],
                'gameweek' => 6,
            ],
        ]);

        // Sample League Standings
        $leagueStandings = [
            (object)[
                'position' => 1,
                'team_name' => 'Red Devils FC',
                'manager' => 'James Wilson',
                'points' => 1420
            ],
            (object)[
                'position' => 2,
                'team_name' => 'Blue Warriors',
                'manager' => 'Sarah Johnson',
                'points' => 1398
            ],
            (object)[
                'position' => 3,
                'team_name' => 'Cityzens',
                'manager' => 'Michael Brown',
                'points' => 1375
            ],
            (object)[
                'position' => 4,
                'team_name' => Auth::user()->name . "'s Team",
                'manager' => Auth::user()->name,
                'points' => 1248
            ]
        ];

        // Sample Recent News
        $recentNews = [
            (object)[
                'title' => 'Haaland injury update',
                'description' => 'Expected return: Gameweek 10',
                'time' => '2 hours ago'
            ],
            (object)[
                'title' => 'Price rises predicted',
                'description' => 'Saka, Maddison expected to rise',
                'time' => '5 hours ago'
            ],
            (object)[
                'title' => 'Gameweek 9 tips',
                'description' => 'Best captain choices',
                'time' => '1 day ago'
            ]
        ];

        // Compute user stats (fallbacks if no team)
        $userStats = [
            'global_rank' => $fantasyTeam ? 124 : 'N/A',
            'total_points' => $fantasyTeam->total_points ?? 0,
            'leagues_joined' => 3,
            'free_transfers' => 2,
            'has_team' => (bool) $fantasyTeam
        ];

        // Fetch top players globally (from FPL API)
$bootstrap = \Illuminate\Support\Facades\Http::timeout(20)
    ->get('https://fantasy.premierleague.com/api/bootstrap-static/')
    ->json();

$topPlayers = collect($bootstrap['elements'] ?? [])
    ->sortByDesc('total_points')
    ->take(5)
    ->map(function ($p) use ($bootstrap) {
        $teams = collect($bootstrap['teams'] ?? [])->keyBy('id');
        $team = $teams[$p['team']] ?? null;

        $positions = [
            1 => 'GK',
            2 => 'DEF',
            3 => 'MID',
            4 => 'FWD',
        ];

        return (object)[
            'id' => $p['id'],
            'name' => $p['web_name'],
            'web_name' => $p['web_name'],
            'position' => $positions[$p['element_type']] ?? '-',
            'team' => (object)[
                'name' => $team['name'] ?? 'Unknown',
                'short_name' => $team['short_name'] ?? 'UNK',
            ],
            'total_points' => $p['total_points'],
            'event_points' => $p['event_points'],
            'points' => $p['total_points'], // alias for compatibility
            'price' => $p['now_cost'] / 10,
        ];
    });

       return view('dashboard', compact(
    'fantasyTeam',
    'myTeamPlayers',
    'topGames',
    'userStats',
));

    }

    
}
