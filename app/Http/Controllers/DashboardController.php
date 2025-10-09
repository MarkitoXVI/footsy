<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fixture;
use App\Models\FantasyTeam;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Get user's fantasy team (if exists)
        $fantasyTeam = Auth::user()->fantasyTeam;
        
        // Top Games (Gameweek 6) - explicit selection with results and scorers
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
        
        // Get league standings (sample data - replace with your actual data)
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
        
        // Get recent news (sample data - replace with your actual data)
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
        
        // Get user stats
        $userStats = [
            'global_rank' => $fantasyTeam ? 124 : 'N/A',
            'total_points' => $fantasyTeam ? $fantasyTeam->total_points : 0,
            'leagues_joined' => 3,
            'free_transfers' => 2,
            'has_team' => (bool) $fantasyTeam
        ];
        
        return view('dashboard', compact(
            'fantasyTeam', 
            'topGames', 
            'leagueStandings', 
            'recentNews',
            'userStats'
        ));
    }

    // ... other methods
}