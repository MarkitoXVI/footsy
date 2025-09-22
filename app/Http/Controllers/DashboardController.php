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
        
        // Get upcoming fixtures - USING kickoff_time INSTEAD OF match_date
        $upcomingFixtures = Fixture::with(['homeTeam', 'awayTeam'])
            ->where('kickoff_time', '>=', now())
            ->orderBy('kickoff_time', 'asc')
            ->limit(5)
            ->get();
        
        // If no fixtures in database, use sample data
        if ($upcomingFixtures->isEmpty()) {
            $upcomingFixtures = collect([
                (object)[
                    'home_team' => (object)['name' => 'Man City', 'short_name' => 'MCI'],
                    'away_team' => (object)['name' => 'Liverpool', 'short_name' => 'LIV'],
                    'kickoff_time' => now()->addDays(2)
                ],
                (object)[
                    'home_team' => (object)['name' => 'Arsenal', 'short_name' => 'ARS'],
                    'away_team' => (object)['name' => 'Chelsea', 'short_name' => 'CHE'],
                    'kickoff_time' => now()->addDays(3)
                ],
                (object)[
                    'home_team' => (object)['name' => 'Man United', 'short_name' => 'MUN'],
                    'away_team' => (object)['name' => 'Tottenham', 'short_name' => 'TOT'],
                    'kickoff_time' => now()->addDays(4)
                ]
            ]);
        }
        
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
            'upcomingFixtures', 
            'leagueStandings', 
            'recentNews',
            'userStats'
        ));
    }

    // ... other methods
}