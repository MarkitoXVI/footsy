<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class FixturesController extends Controller
{
    public function index()
    {
        try {
            // Fetch live fixture + team data
            $fixturesResponse = Http::get('https://fantasy.premierleague.com/api/fixtures/');
            $bootstrapResponse = Http::get('https://fantasy.premierleague.com/api/bootstrap-static/');

            $fixtures = collect($fixturesResponse->json());
            $teams = collect($bootstrapResponse->json()['teams'])->keyBy('id');

            // Map fixtures to a clean structure
            $formattedFixtures = $fixtures->map(function ($fixture) use ($teams) {
                return [
                    'kickoff_time' => $fixture['kickoff_time'],
                    'event' => $fixture['event'],
                    'home_team' => $teams[$fixture['team_h']]['name'] ?? 'Unknown',
                    'away_team' => $teams[$fixture['team_a']]['name'] ?? 'Unknown',
                    'home_short' => $teams[$fixture['team_h']]['short_name'] ?? '',
                    'away_short' => $teams[$fixture['team_a']]['short_name'] ?? '',
                    'home_score' => $fixture['team_h_score'],
                    'away_score' => $fixture['team_a_score'],
                    'finished' => $fixture['finished'],
                ];
            });

            // Group by date (YYYY-MM-DD)
            $fixturesByDate = $formattedFixtures->groupBy(function ($fixture) {
                return substr($fixture['kickoff_time'], 0, 10);
            });

        } catch (\Exception $e) {
            $fixturesByDate = collect();
        }

        return view('fixtures.index', compact('fixturesByDate'));
    }
}
