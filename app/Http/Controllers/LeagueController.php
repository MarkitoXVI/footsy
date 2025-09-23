<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeagueController extends Controller
{
    // Temporary storage for demo (in real app, use database)
    private static $leagues = [];
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get user's joined leagues
        $userLeagues = array_filter(self::$leagues, function($league) {
            return in_array(Auth::id(), $league['members'] ?? []);
        });
        
        // Get other available leagues
        $otherLeagues = array_filter(self::$leagues, function($league) {
            return !in_array(Auth::id(), $league['members'] ?? []);
        });
        
        return view('leagues.index', compact('userLeagues', 'otherLeagues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leagues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'league_name' => 'required|string|max:255',
            'league_description' => 'required|string',
            'max_participants' => 'required|integer|min:2|max:100',
            'privacy' => 'required|in:public,private',
            'custom_rules' => 'nullable|string',
        ]);
        
        // Generate unique league code
        $leagueCode = strtoupper(substr(md5(uniqid()), 0, 6));
        
        // Create new league
        $league = [
            'id' => count(self::$leagues) + 1,
            'name' => $validated['league_name'],
            'description' => $validated['league_description'],
            'max_participants' => $validated['max_participants'],
            'privacy' => $validated['privacy'],
            'custom_rules' => $validated['custom_rules'] ?? '',
            'code' => $leagueCode,
            'admin_id' => Auth::id(),
            'admin_name' => Auth::user()->name,
            'created_at' => now()->format('F j, Y'),
            'members' => [Auth::id()], // Admin is automatically a member
            'participant_count' => 1,
            'allow_transfers' => $request->has('allow_transfers'),
            'use_wildcards' => $request->has('use_wildcards'),
            'show_rankings' => $request->has('show_rankings'),
        ];
        
        // Add to leagues array
        self::$leagues[] = $league;
        
        return redirect()->route('leagues.index')
            ->with('success', 'League created successfully! League code: ' . $leagueCode);
    }

    /**
     * Join a league.
     */
    public function join($leagueId)
    {
        $league = collect(self::$leagues)->firstWhere('id', $leagueId);
        
        if ($league && !in_array(Auth::id(), $league['members'])) {
            $league['members'][] = Auth::id();
            $league['participant_count']++;
            
            // Update the league in the array
            $key = array_search($league, self::$leagues);
            if ($key !== false) {
                self::$leagues[$key] = $league;
            }
        }
        
        return redirect()->route('leagues.index')
            ->with('success', 'Successfully joined the league!');
    }

    /**
     * Leave a league.
     */
    public function leave($leagueId)
    {
        $league = collect(self::$leagues)->firstWhere('id', $leagueId);
        
        if ($league && in_array(Auth::id(), $league['members'])) {
            $key = array_search(Auth::id(), $league['members']);
            if ($key !== false) {
                unset($league['members'][$key]);
                $league['participant_count']--;
                
                // Update the league in the array
                $arrayKey = array_search($league, self::$leagues);
                if ($arrayKey !== false) {
                    self::$leagues[$arrayKey] = $league;
                }
            }
        }
        
        return redirect()->route('leagues.index')
            ->with('success', 'Successfully left the league!');
    }
}