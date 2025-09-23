<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\FantasyTeam;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::with('team')->get();
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for selecting players by position.
     */
    public function select($position)
    {
        $players = Player::with('team')
            ->where('position', ucfirst($position))
            ->get();
            
        return view('players.select', compact('players', 'position'));
    }

    /**
     * Add a player to the user's fantasy team.
     */
    public function addToTeam(Request $request)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:players,id',
            'position' => 'required|in:goalkeeper,defender,midfielder,forward'
        ]);

        // Get or create user's fantasy team
        $fantasyTeam = FantasyTeam::firstOrCreate(
            ['user_id' => auth()->id()],
            ['name' => auth()->user()->name . "'s Team", 'budget' => 100.00]
        );

        // Add player to team (you'll need to implement this logic)
        // This is a simplified version - you'll need to handle position limits, budget, etc.

        return redirect()->route('fantasy-team.index')
            ->with('success', 'Player added to your team!');
    }

    /**
     * Search for players.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $players = Player::with('team')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhereHas('team', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();

        return view('players.search', compact('players', 'query'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    /**
     * Display players by position.
     */
    public function byPosition($position)
    {
        $players = Player::with('team')
            ->where('position', ucfirst($position))
            ->get();

        return view('players.by-position', compact('players', 'position'));
    }
}