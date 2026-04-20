<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $fantasyTeam = $user->fantasyTeam;

        // ====================== MY TEAM PLAYERS ======================
        $myTeamPlayers = collect();

        if ($fantasyTeam && $fantasyTeam->players) {
            $playerIds = is_string($fantasyTeam->players) 
                ? json_decode($fantasyTeam->players, true) 
                : $fantasyTeam->players;

            if (!empty($playerIds)) {
                $bootstrap = Http::timeout(15)
                    ->get('https://fantasy.premierleague.com/api/bootstrap-static/')
                    ->json();

                $elements = collect($bootstrap['elements'] ?? []);
                $teamsData = collect($bootstrap['teams'] ?? [])->keyBy('id');

                $myTeamPlayers = $elements
                    ->whereIn('id', $playerIds)
                    ->map(function ($p) use ($teamsData) {
                        $team = $teamsData[$p['team']] ?? null;

                        return (object)[
                            'web_name'     => $p['web_name'],
                            'team'         => (object)[
                                'short_name' => $team['short_name'] ?? 'UNK',
                            ],
                            'price'        => $p['now_cost'] / 10,
                            'event_points' => $p['event_points'] ?? 0,
                        ];
                    })
                    ->values();
            }
        }

        // ====================== GW POINTS (Gameweek Points) ======================
        $gwPoints = $myTeamPlayers->sum('event_points');

        // ====================== USER STATS ======================
        $userStats = [
            'has_team'       => (bool) $fantasyTeam,
            'total_points'   => $fantasyTeam?->total_points ?? 0,
            'gw_points'      => $gwPoints,                    // ← Used in Dashboard
            'global_rank'    => $fantasyTeam?->global_rank ?? 'N/A',
            'leagues_joined' => $fantasyTeam?->leagues?->count() ?? 3,
            'free_transfers' => $fantasyTeam?->free_transfers ?? 2,
        ];

        // ====================== TOP GAMES (Sample for now) ======================
        $topGames = collect([
            (object) [
                'home_team' => (object)['name' => 'Brentford', 'short_name' => 'BRE'],
                'away_team' => (object)['name' => 'Manchester United', 'short_name' => 'MUN'],
                'score_home' => 3,
                'score_away' => 1,
                'gameweek' => 6,
            ],
            (object) [
                'home_team' => (object)['name' => 'Chelsea', 'short_name' => 'CHE'],
                'away_team' => (object)['name' => 'Brighton', 'short_name' => 'BHA'],
                'score_home' => 1,
                'score_away' => 3,
                'gameweek' => 6,
            ],
            (object) [
                'home_team' => (object)['name' => 'Crystal Palace', 'short_name' => 'CRY'],
                'away_team' => (object)['name' => 'Liverpool', 'short_name' => 'LIV'],
                'score_home' => 2,
                'score_away' => 1,
                'gameweek' => 6,
            ],
        ]);

        return view('dashboard', compact(
            'fantasyTeam',
            'myTeamPlayers',
            'topGames',
            'userStats'
        ));
    }
}