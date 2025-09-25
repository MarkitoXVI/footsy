<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transfer;
use App\Models\Player;
use App\Models\Team;

class TransferController extends Controller
{
    /**
     * Display a listing of transfers.
     */
    public function index()
{
    $user = Auth::user();
    $fantasyTeam = FantasyTeam::where('user_id', $user->id)->with('players')->first();
    $allPlayers = Player::all();
    
    return view('transfers.index', compact('fantasyTeam', 'allPlayers'));
}

    /**
     * Show the form for making a transfer.
     */
    public function create()
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('team.create')->with('error', 'You need to create a team first!');
        }
        
        $team->load('players');
        
        $playersOut = $team->players;
        $playersIn = Player::whereNotIn('id', $playersOut->pluck('id'))->get();
        
        $remainingBudget = $team->budget;
        $freeTransfers = 1; // This would be calculated based on game rules
        
        return view('transfers.create', compact('playersOut', 'playersIn', 'remainingBudget', 'freeTransfers'));
    }

    /**
     * Process a transfer.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('team.create')->with('error', 'You need to create a team first!');
        }
        
        $validated = $request->validate([
            'player_out_id' => 'required|exists:players,id',
            'player_in_id' => 'required|exists:players,id|different:player_out_id',
        ]);
        
        $playerOut = Player::find($validated['player_out_id']);
        $playerIn = Player::find($validated['player_in_id']);
        
        // Check if the player being transferred out is in the user's team
        if (!$team->players->contains($playerOut->id)) {
            return redirect()->back()->with('error', 'Selected player is not in your team.');
        }
        
        // Check if the user has enough budget
        $cost = $playerIn->price - $playerOut->price;
        if ($cost > $team->budget) {
            return redirect()->back()->with('error', 'Insufficient budget for this transfer.');
        }
        
        // Process the transfer
        $team->players()->detach($playerOut->id);
        $team->players()->attach($playerIn->id);
        
        // Update budget
        $team->budget -= $cost;
        $team->save();
        
        // Record the transfer
        Transfer::create([
            'team_id' => $team->id,
            'player_out_id' => $playerOut->id,
            'player_in_id' => $playerIn->id,
            'cost' => $cost,
        ]);
        
        return redirect()->route('transfers.index')->with('status', 'Transfer completed successfully!');
    }

    /**
     * Display transfer history.
     */
    public function history()
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('team.create')->with('error', 'You need to create a team first!');
        }
        
        $transfers = Transfer::with(['playerOut', 'playerIn'])
            ->where('team_id', $team->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('transfers.history', compact('transfers'));
    }

    /**
     * Show wildcard page.
     */
    public function wildcard()
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('team.create')->with('error', 'You need to create a team first!');
        }
        
        $wildcardAvailable = true; // This would be calculated based on game rules
        
        return view('transfers.wildcard', compact('wildcardAvailable'));
    }

    /**
     * Use wildcard.
     */
    public function useWildcard(Request $request)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('team.create')->with('error', 'You need to create a team first!');
        }
        
        $validated = $request->validate([
            'players' => 'required|array|size:15',
            'players.*' => 'exists:players,id',
        ]);
        
        // Check if wildcard is available
        $wildcardAvailable = true; // This would be calculated based on game rules
        
        if (!$wildcardAvailable) {
            return redirect()->back()->with('error', 'Wildcard is not available at this time.');
        }
        
        // Replace all players
        $team->players()->sync($validated['players']);
        
        // Record wildcard usage
        // This would be stored in the database
        
        return redirect()->route('team.index')->with('status', 'Wildcard used successfully! Your team has been completely changed.');
    }
}