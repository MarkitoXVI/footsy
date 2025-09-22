<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Models\Fixture;

class StatisticController extends Controller
{
    /**
     * Display statistics dashboard.
     */
    public function index()
    {
        // Top 5 players by points
        $topPlayers = Player::with('team')
            ->orderBy('total_points', 'desc')
            ->take(5)
            ->get();
            
        // Top 5 players by goals
        $topScorers = Player::with('team')
            ->orderBy('goals', 'desc')
            ->take(5)
            ->get();
            
        // Top 5 players by assists
        $topAssists = Player::with('team')
            ->orderBy('assists', 'desc')
            ->take(5)
            ->get();
            
        // Most selected players
        $mostSelected = Player::with('team')
            ->orderBy('selected_by', 'desc')
            ->take(5)
            ->get();
            
        return view('statistics.index', compact(
            'topPlayers', 
            'topScorers', 
            'topAssists', 
            'mostSelected'
        ));
    }

    /**
     * Display player statistics.
     */
    public function players(Request $request)
    {
        $query = Player::with('team');
        
        // Apply filters if provided
        if ($request->has('position') && $request->position) {
            $query->where('position', $request->position);
        }
        
        if ($request->has('team_id') && $request->team_id) {
            $query->where('team_id', $request->team_id);
        }
        
        if ($request->has('sort') && $request->sort) {
            $query->orderBy($request->sort, 'desc');
        } else {
            $query->orderBy('total_points', 'desc');
        }
        
        $players = $query->paginate(20);
        
        $positions = Player::select('position')->distinct()->pluck('position');
        $teams = Team::all();
        
        return view('statistics.players', compact('players', 'positions', 'teams'));
    }

    /**
     * Display team statistics.
     */
    public function teams()
    {
        $teams = Team::withCount('players')
            ->withSum('players', 'total_points')
            ->withSum('players', 'goals')
            ->withSum('players', 'assists')
            ->orderBy('players_sum_total_points', 'desc')
            ->get();
            
        return view('statistics.teams', compact('teams'));
    }

    /**
     * Display points statistics.
     */
    public function points()
    {
        // Get points distribution by position
        $pointsByPosition = Player::select('position')
            ->selectRaw('AVG(total_points) as avg_points')
            ->selectRaw('MAX(total_points) as max_points')
            ->selectRaw('MIN(total_points) as min_points')
            ->groupBy('position')
            ->get();
            
        // Get top scoring players each week (simplified)
        $weeklyTopScorers = [
            ['gameweek' => 1, 'player' => 'Erling Haaland', 'points' => 16],
            ['gameweek' => 2, 'player' => 'Bukayo Saka', 'points' => 15],
            ['gameweek' => 3, 'player' => 'Son Heung-min', 'points' => 17],
            ['gameweek' => 4, 'player' => 'Mohamed Salah', 'points' => 14],
            ['gameweek' => 5, 'player' => 'James Maddison', 'points' => 13],
        ];
        
        return view('statistics.points', compact('pointsByPosition', 'weeklyTopScorers'));
    }
}