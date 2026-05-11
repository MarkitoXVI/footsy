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

            if (is_string($playerIds)) {
                $playerIds = json_decode($playerIds, true);
            }

            if (!empty($playerIds) && is_array($playerIds)) {
                try {
                    $bootstrap = Http::timeout(20)
                        ->withHeaders(['User-Agent' => 'Mozilla/5.0'])
                        ->get('https://fantasy.premierleague.com/api/bootstrap-static/')
                        ->json();

                    $elements = collect($bootstrap['elements'] ?? []);
                    $teamsData = collect($bootstrap['teams'] ?? [])->keyBy('id');

                    $myTeamPlayers = $elements
                        ->whereIn('id', $playerIds)
                        ->map(function ($p) use ($teamsData) {
                            $team = $teamsData[$p['team']] ?? null;
                            return (object)[
                                'name' => $p['web_name'] ?? 'Unknown Player',
                                'team' => (object)[
                                    'short_name' => $team['short_name'] ?? 'UNK',
                                ],
                                'price' => number_format($p['now_cost'] / 10, 1),
                                'points' => $p['event_points'] ?? 0,
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
        $topGames = $this->getTopGames();

        // ====================== LEAGUE STANDINGS (REAL DATA) ======================
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
     * Get Top Games for Dashboard
     */
    private function getTopGames()
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0'
            ])->timeout(15)
              ->get('https://fantasy.premierleague.com/api/bootstrap-static/');

            if ($response->successful()) {
                $data = $response->json();
                $fixtureResponse = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0'
                ])->timeout(15)
                  ->get('https://fantasy.premierleague.com/api/fixtures/');

                if ($fixtureResponse->successful()) {
                    $allFixtures = $fixtureResponse->json();
                    $teamsData = collect($data['teams'] ?? [])->keyBy('id');
                    $events = collect($data['events'] ?? []);
                    
                    // Get current gameweek
                    $currentEvent = $events->firstWhere('is_current', true);
                    $gameweekId = $currentEvent['id'] ?? 1;
                    
                    $fixtures = collect($allFixtures)
                        ->where('event', $gameweekId)
                        ->take(5)
                        ->map(function ($fixture) use ($teamsData) {
                            $homeTeam = $teamsData[$fixture['team_h']] ?? null;
                            $awayTeam = $teamsData[$fixture['team_a']] ?? null;
                            
                            $finished = $fixture['finished'] ?? false;
                            $started = $fixture['started'] ?? false;
                            
                            return (object) [
                                'id' => $fixture['id'],
                                'homeTeam' => (object) [
                                    'name' => $homeTeam['name'] ?? 'Home Team',
                                    'short_name' => $homeTeam['short_name'] ?? 'HOM',
                                ],
                                'awayTeam' => (object) [
                                    'name' => $awayTeam['name'] ?? 'Away Team',
                                    'short_name' => $awayTeam['short_name'] ?? 'AWY',
                                ],
                                'home_score' => $fixture['team_h_score'] ?? null,
                                'away_score' => $fixture['team_a_score'] ?? null,
                                'kickoff_time' => isset($fixture['kickoff_time']) 
                                    ? \Carbon\Carbon::parse($fixture['kickoff_time'])
                                    : null,
                                'finished' => $finished,
                                'started' => $started,
                                'stadium' => null,
                            ];
                        });
                    
                    if ($fixtures->isNotEmpty()) {
                        return $fixtures;
                    }
                }
            }
            
            return collect();
            
        } catch (\Exception $e) {
            return collect();
        }
    }

    /**
     * Get League Standings for Dashboard (Real Data from FPL API)
     */
    private function getLeagueStandings($user)
    {
        try {
            // First, try to get the user's league from database
            $league = $user->leagues()->first();
            
            if ($league && $league->league_code) {
                // If user is in a league, fetch standings from FPL API
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0'
                ])->timeout(15)
                  ->get("https://fantasy.premierleague.com/api/leagues-classic/{$league->league_code}/standings/");
                
                if ($response->successful()) {
                    $data = $response->json();
                    $standings = $data['standings']['results'] ?? [];
                    
                    return collect($standings)
                        ->take(5)
                        ->map(function ($standing, $index) {
                            return (object) [
                                'user_id' => $standing['entry'],
                                'team_name' => $standing['entry_name'],
                                'user_name' => $standing['player_name'],
                                'total_points' => $standing['total'],
                                'rank' => $standing['rank'] ?? $index + 1,
                            ];
                        });
                }
            }
            
            // Fallback: Try to get public league data
            $publicLeagueResponse = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0'
            ])->timeout(15)
              ->get('https://fantasy.premierleague.com/api/leagues-classic/314/standings/'); // Example league ID
            
            if ($publicLeagueResponse->successful()) {
                $data = $publicLeagueResponse->json();
                $standings = $data['standings']['results'] ?? [];
                
                return collect($standings)
                    ->take(5)
                    ->map(function ($standing, $index) use ($user) {
                        return (object) [
                            'user_id' => $standing['entry'],
                            'team_name' => $standing['entry_name'],
                            'user_name' => $standing['player_name'],
                            'total_points' => $standing['total'],
                            'rank' => $standing['rank'] ?? $index + 1,
                        ];
                    });
            }
            
            // If all else fails, return empty collection
            return collect();
            
        } catch (\Exception $e) {
            // If API fails or no league, return empty collection
            return collect();
        }
    }
}