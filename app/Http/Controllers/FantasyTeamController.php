<?php

namespace App\Http\Controllers;

use App\Models\FantasyTeam;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FantasyTeamController extends Controller
{
    /**
     * Parāda resursa sarakstu.
     */
    public function index()
    {
        // Get the user's fantasy team with players
        $fantasyTeam = Auth::user()->fantasyTeam;
        
        return view('fantasy-team.index', compact('fantasyTeam'));
    }
    /** 
     * Parāda formu jauna resursa izveidei.
     */
    /**
 * Show the form for creating a new resource.
 */
public function create()
{
    // Check if user already has a team
    if (Auth::user()->fantasyTeam) {
        return redirect()->route('fantasy-team.index')
            ->with('error', 'You already have a fantasy team!');
    }
    
    return view('fantasy-team.create');
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'team_name' => 'required|string|max:255',
        'formation' => 'required|string',
        'players' => 'required|array|size:15', // 11 starters + 4 subs
        'players.*' => 'exists:players,id',
        'captain_id' => 'required|exists:players,id'
    ]);
    
    // Create the fantasy team
    $fantasyTeam = FantasyTeam::create([
        'name' => $validated['team_name'],
        'user_id' => Auth::id(),
        'formation' => $validated['formation'],
        'budget' => 100.00,
        'total_points' => 0
    ]);
    
    // Attach players to the team
    $fantasyTeam->players()->attach($validated['players']);
    
    // Set captain
    $fantasyTeam->players()->updateExistingPivot($validated['captain_id'], [
        'is_captain' => true
    ]);
    
    return redirect()->route('fantasy-team.index')
        ->with('success', 'Fantasy team created successfully!');
}

    /**
     * Parāda norādīto resursu.
     */
    public function show(FantasyTeam $fantasyTeam)
    {
        // Autorizācija - lietotājs var skatīt tikai savu komandu
        $this->authorize('view', $fantasyTeam);
        
        return view('fantasy-team.show', compact('fantasyTeam'));
    }

    /**
     * Parāda formu resursa rediģēšanai.
     */
    public function edit(FantasyTeam $fantasyTeam)
    {
        // Autorizācija - lietotājs var rediģēt tikai savu komandu
        $this->authorize('update', $fantasyTeam);
        
        $players = Player::all();
        
        return view('fantasy-team.edit', compact('fantasyTeam', 'players'));
    }

    /**
     * Atjaunina norādīto resursu datubāzē.
     */
    public function update(Request $request, FantasyTeam $fantasyTeam)
    {
        // Autorizācija - lietotājs var atjaunināt tikai savu komandu
        $this->authorize('update', $fantasyTeam);
        
        // Validē pieprasījumu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'players' => 'required|array|size:15',
            'players.*' => 'exists:players,id',
            'captain_id' => 'required|exists:players,id'
        ]);
        
        // Atjaunina komandu
        $fantasyTeam->update([
            'name' => $validated['name']
        ]);
        
        // Sinhronizē spēlētājus
        $fantasyTeam->players()->sync($validated['players']);
        
        // Visus spēlētājus sākumā uzstāda kā ne-kapteini
        $fantasyTeam->players()->update(['is_captain' => false]);
        
        // Uzstāda jauno kapteini
        $fantasyTeam->players()->updateExistingPivot($validated['captain_id'], [
            'is_captain' => true
        ]);
        
        return redirect()->route('fantasy-team.index')
            ->with('success', 'Fantāzijas komanda veiksmīgi atjaunināta!');
    }

    /**
     * Dzēš norādīto resursu no datubāzes.
     */
    public function destroy(FantasyTeam $fantasyTeam)
    {
        // Autorizācija - lietotājs var dzēst tikai savu komandu
        $this->authorize('delete', $fantasyTeam);
        
        $fantasyTeam->delete();
        
        return redirect()->route('dashboard')
            ->with('success', 'Fantāzijas komanda veiksmīgi dzēsta!');
    }

    /**
     * Izvēlas kapteini fantāzijas komandai.
     */
    public function selectCaptain(Request $request, FantasyTeam $fantasyTeam)
    {
        // Autorizācija - lietotājs var atjaunināt tikai savu komandu
        $this->authorize('update', $fantasyTeam);
        
        $validated = $request->validate([
            'captain_id' => 'required|exists:players,id'
        ]);
        
        // Visus spēlētājus sākumā uzstāda kā ne-kapteini
        $fantasyTeam->players()->update(['is_captain' => false]);
        
        // Uzstāda jauno kapteini
        $fantasyTeam->players()->updateExistingPivot($validated['captain_id'], [
            'is_captain' => true
        ]);
        
        return redirect()->back()
            ->with('success', 'Kapteinis veiksmīgi izvēlēts!');
    }
}