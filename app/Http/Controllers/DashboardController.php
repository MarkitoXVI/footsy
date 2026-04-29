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
            $playerIds = $fantasyTeam->players;

            // Handle both string (JSON) and array
            if (is_string($playerIds)) {
                $playerIds = json_decode($playerIds, true);
            }

            if (!empty($playerIds) && is_array($playerIds)) {
                try {
                    $bootstrap = Http::timeout(20)
                        ->get('https://fantasy.premierleague.com/api/bootstrap-static/')
                        ->json();

                    $elements = collect($bootstrap['elements'] ?? []);
                    $teamsData = collect($bootstrap['teams'] ?? [])->keyBy('id');

                    $myTeamPlayers = $elements
                        ->whereIn('id', $playerIds)
                        ->map(function ($p) use ($teamsData) {
                            $team = $teamsData[$p['team']] ?? null;

                            return (object)[
                                'name'         => $p['web_name'] ?? 'Unknown Player',
                                'team'         => (object)[
                                    'short_name' => $team['short_name'] ?? 'UNK',
                                ],
                                'price'        => number_format($p['now_cost'] / 10, 1),
                                'points'       => $p['event_points'] ?? 0,
                            ];
                        })
                        ->values();
                } catch (\Exception $e) {
                    $myTeamPlayers = collect();
                }
            }
        }

        // ====================== GW POINTS ======================
        $gwPoints = $myTeamPlayers->sum('points');

        // ====================== USER STATS ======================
        $userStats = [
            'has_team'       => (bool) $fantasyTeam,
            'total_points'   => $fantasyTeam?->total_points ?? 0,
            'gw_points'      => $gwPoints,
            'global_rank'    => $fantasyTeam?->global_rank ?? 'N/A',
            'leagues_joined' => $user->leagues()->count(),
            'free_transfers' => $fantasyTeam?->free_transfers ?? 2,
        ];

        // ====================== TOP GAMES ======================
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

        // ====================== LEAGUE STANDINGS ======================
        $leagueStandings = $this->getLeagueStandings($user);

        return view('dashboard', compact(
            'fantasyTeam',
            'myTeamPlayers',
            'topGames',
            'userStats',
            'leagueStandings'
        ));
    }

    /**
     * Get League Standings for Dashboard
     */
    private function getLeagueStandings($user)
    {
        $league = $user->leagues()->first();

        if (!$league) {
            return collect();
        }

        return $league->users()
            ->with('fantasyTeam')
            ->get()
            ->sortByDesc(function ($u) {
                return $u->fantasyTeam?->total_points ?? 0;
            })
            ->take(5)
            ->values()
            ->map(function ($u, $index) {
                return (object) [
                    'user_id'      => $u->id,
                    'team_name'    => $u->fantasyTeam?->name ?? 'Unnamed Team',
                    'user_name'    => $u->name,
                    'total_points' => $u->fantasyTeam?->total_points ?? 0,
                    'rank'         => $index + 1,
                ];
            });
    }
}