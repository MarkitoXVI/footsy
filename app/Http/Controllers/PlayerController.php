<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends Controller
{
    /**
     * Display a listing of players.
     */
    public function index()
    {
        $players = Player::with('team')
            ->orderBy('total_points', 'desc')
            ->paginate(20);
            
        $positions = Player::select('position')->distinct()->pluck('position');
        $teams = Team::select('id', 'name')->get();
        
        return view('players.index', compact('players', 'positions', 'teams'));
    }

    /**
     * Search for players.
     */
    public function search(Request $request)
    {
        $query = Player::with('team');
        
        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        if ($request->has('position') && $request->position) {
            $query->where('position', $request->position);
        }
        
        if ($request->has('team_id') && $request->team_id) {
            $query->where('team_id', $request->team_id);
        }
        
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        
        $players = $query->orderBy('total_points', 'desc')->paginate(20);
        
        $positions = Player::select('position')->distinct()->pluck('position');
        $teams = Team::select('id', 'name')->get();
        
        return view('players.search', compact('players', 'positions', 'teams'));
    }

    /**
     * Display the specified player.
     */
    public function show(Player $player)
    {
        $player->load('team', 'fixtures');
        
        // Get similar players (same position, similar price)
        $similarPlayers = Player::where('position', $player->position)
            ->where('id', '!=', $player->id)
            ->whereBetween('price', [$player->price - 2, $player->price + 2])
            ->orderBy('total_points', 'desc')
            ->take(5)
            ->get();
        
        return view('players.show', compact('player', 'similarPlayers'));
    }

    /**
     * Display players by position.
     */
    public function byPosition($position)
    {
        $validPositions = ['GK', 'DEF', 'MID', 'FWD'];
        
        if (!in_array($position, $validPositions)) {
            return redirect()->route('players.index')->with('error', 'Invalid position specified.');
        }
        
        $players = Player::with('team')
            ->where('position', $position)
            ->orderBy('total_points', 'desc')
            ->paginate(20);
            
        $teams = Team::select('id', 'name')->get();
        
        return view('players.by-position', compact('players', 'position', 'teams'));
    }
}