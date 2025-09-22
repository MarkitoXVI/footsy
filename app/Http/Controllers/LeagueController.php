<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\League;
use App\Models\Team;

class LeagueController extends Controller
{
    /**
     * Display a listing of leagues.
     */
    public function index()
    {
        $user = Auth::user();
        $team = $user->team;
        
        $leagues = League::with(['teams' => function($query) {
            $query->orderBy('points', 'desc');
        }])->get();
        
        $userLeagues = $team ? $team->leagues : collect();
        
        return view('leagues.index', compact('leagues', 'userLeagues', 'team'));
    }

    /**
     * Show the form for creating a new league.
     */
    public function create()
    {
        return view('leagues.create');
    }

    /**
     * Store a newly created league.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('team.create')->with('error', 'You need to create a team first!');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_private' => 'boolean',
            'password' => 'nullable|string|min:4|required_if:is_private,true',
        ]);
        
        $league = League::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'is_private' => $validated['is_private'] ?? false,
            'password' => $validated['password'] ?? null,
            'admin_id' => $user->id,
        ]);
        
        // Add the creator's team to the league
        $league->teams()->attach($team->id);
        
        return redirect()->route('leagues.show', $league)->with('status', 'League created successfully!');
    }

    /**
     * Display the specified league.
     */
    public function show(League $league)
    {
        $league->load(['teams' => function($query) {
            $query->orderBy('points', 'desc');
        }, 'admin']);
        
        $user = Auth::user();
        $userTeam = $user->team;
        $isMember = $userTeam ? $league->teams->contains($userTeam->id) : false;
        
        return view('leagues.show', compact('league', 'isMember'));
    }

    /**
     * Show the form for joining a league.
     */
    public function join(League $league)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('team.create')->with('error', 'You need to create a team first!');
        }
        
        $isMember = $league->teams->contains($team->id);
        
        if ($isMember) {
            return redirect()->route('leagues.show', $league)->with('info', 'You are already a member of this league.');
        }
        
        return view('leagues.join', compact('league'));
    }

    /**
     * Process joining a league.
     */
    public function processJoin(Request $request, League $league)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->route('team.create')->with('error', 'You need to create a team first!');
        }
        
        // Check if league is private and requires password
        if ($league->is_private) {
            $validated = $request->validate([
                'password' => 'required|string',
            ]);
            
            if ($validated['password'] !== $league->password) {
                return redirect()->back()->with('error', 'Incorrect password for this private league.');
            }
        }
        
        // Add team to league
        $league->teams()->attach($team->id);
        
        return redirect()->route('leagues.show', $league)->with('status', 'Successfully joined the league!');
    }

    /**
     * Display league standings.
     */
    public function standings(League $league)
    {
        $league->load(['teams' => function($query) {
            $query->orderBy('points', 'desc');
        }]);
        
        return view('leagues.standings', compact('league'));
    }

    /**
     * Leave a league.
     */
    public function leave(League $league)
    {
        $user = Auth::user();
        $team = $user->team;
        
        if ($team && $league->teams->contains($team->id)) {
            $league->teams()->detach($team->id);
            
            // If the league admin is leaving, assign new admin or delete if empty
            if ($league->admin_id === $user->id) {
                $newAdmin = $league->teams()->first();
                if ($newAdmin) {
                    $league->update(['admin_id' => $newAdmin->user_id]);
                } else {
                    $league->delete();
                    return redirect()->route('leagues.index')->with('status', 'League deleted as you were the last member.');
                }
            }
            
            return redirect()->route('leagues.index')->with('status', 'Successfully left the league.');
        }
        
        return redirect()->back()->with('error', 'You are not a member of this league.');
    }
}