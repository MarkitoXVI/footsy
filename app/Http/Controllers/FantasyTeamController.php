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
        // Iegūst lietotāja fantāzijas komandu
        $fantasyTeam = Auth::user()->fantasyTeam;
        
        return view('fantasy-team.index', compact('fantasyTeam'));
    }

    /**
     * Parāda formu jauna resursa izveidei.
     */
    public function create()
    {
        // Pārbauda, vai lietotājam jau ir komanda
        if (Auth::user()->fantasyTeam) {
            return redirect()->route('fantasy-team.index')
                ->with('error', 'Jums jau ir fantāzijas komanda!');
        }
        
        // Iegūst spēlētājus izvēlei
        $players = Player::all();
        
        return view('fantasy-team.create', compact('players'));
    }

    /**
     * Saglabā tikko izveidotu resursu datubāzē.
     */
    public function store(Request $request)
    {
        // Validē pieprasījumu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'players' => 'required|array|size:15', // Komandā ir 15 spēlētāji
            'players.*' => 'exists:players,id',
            'captain_id' => 'required|exists:players,id'
        ]);
        
        // Izveido fantāzijas komandu
        $fantasyTeam = FantasyTeam::create([
            'name' => $validated['name'],
            'user_id' => Auth::id(),
            'budget' => 100.00, // Sākuma budžets
        ]);
        
        // Pievieno spēlētājus komandai
        $fantasyTeam->players()->attach($validated['players']);
        
        // Uzstāda kapteini
        $fantasyTeam->players()->updateExistingPivot($validated['captain_id'], [
            'is_captain' => true
        ]);
        
        return redirect()->route('fantasy-team.index')
            ->with('success', 'Fantāzijas komanda veiksmīgi izveidota!');
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