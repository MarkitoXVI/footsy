<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class FixturesController extends Controller
{
    public function index()
    {
        try {
            // Iegūst spēļu un komandu datus no FPL API
            $fixturesResponse = Http::get('https://fantasy.premierleague.com/api/fixtures/');
            $bootstrapResponse = Http::get('https://fantasy.premierleague.com/api/bootstrap-static/');

            // Pārveido atbildes par kolekcijām
            $fixtures = collect($fixturesResponse->json());
            $teams = collect($bootstrapResponse->json()['teams'])->keyBy('id');

            // Formatē spēļu datus strukturētā formātā
            $formattedFixtures = $fixtures->map(function ($fixture) use ($teams) {
                return [
                    'kickoff_time' => $fixture['kickoff_time'], // Spēles sākuma laiks
                    'event' => $fixture['event'], // Notikuma ID
                    'home_team' => $teams[$fixture['team_h']]['name'] ?? 'Unknown', // Mājas komandas nosaukums
                    'away_team' => $teams[$fixture['team_a']]['name'] ?? 'Unknown', // Viesu komandas nosaukums
                    'home_short' => $teams[$fixture['team_h']]['short_name'] ?? '', // Mājas komandas saīsinājums
                    'away_short' => $teams[$fixture['team_a']]['short_name'] ?? '', // Viesu komandas saīsinājums
                    'home_score' => $fixture['team_h_score'], // Mājas komandas rezultāts
                    'away_score' => $fixture['team_a_score'], // Viesu komandas rezultāts
                    'finished' => $fixture['finished'], // Vai spēle ir pabeigta
                ];
            });

            // Grupē spēles pēc datuma (YYYY-MM-DD formātā)
            $fixturesByDate = $formattedFixtures->groupBy(function ($fixture) {
                return substr($fixture['kickoff_time'], 0, 10); // Izgūst datumu no laika stampa
            });

        } catch (\Exception $e) {
            // Ja rodas kļūda, izmanto tukšu kolekciju
            $fixturesByDate = collect();
        }

        // Atgriež skatu ar grupētajām spēlēm
        return view('fixtures.index', compact('fixturesByDate'));
    }
}