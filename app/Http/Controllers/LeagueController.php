<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LeagueController extends Controller
{
    /**
     * Display a single league with standings.
     */
    public function show(League $league)
    {
        $league->load(['admin', 'participants' => function ($q) {
            $q->orderBy('league_user.rank');
        }]);

        // participants relation already orders by rank in model, but we ensure here
        $participants = $league->participants;

        return view('leagues.show', compact('league', 'participants'));
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
{
    $myLeagues = auth()->user()->leagues()->get();
    $otherLeagues = \App\Models\League::whereDoesntHave('users', function($q) {
        $q->where('user_id', auth()->id());
    })->get();

    return view('leagues.index', compact('myLeagues', 'otherLeagues'));
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
                'name' => 'required|string|max:255',
                'privacy' => 'required|in:public,private',
                'description' => 'nullable|string|max:500',
            ]);

            // Automatically generate a code for joining
            $code = strtoupper(Str::random(8));

            // Create the league and assign it to the current user
            $league = League::create([
                'name' => $validated['name'],
                'privacy' => $validated['privacy'],
                'description' => $validated['description'] ?? null,
                'code' => $code,
                'user_id' => auth()->id(), // <-- VERY IMPORTANT
            ]);

            return redirect()->route('leagues.index')->with('success', 'League created successfully!');
        }

    /**
     * Join a league.
     */
    public function join($id)
{
    $league = \App\Models\League::findOrFail($id);

    // Attach the user if not already joined
    if (! $league->users()->where('user_id', auth()->id())->exists()) {
        $league->users()->attach(auth()->id());
    }

    return redirect()->route('leagues.index')->with('success', 'Successfully joined "' . $league->name . '"!');
}


    /**
     * Leave a league.
     */
    public function leave(League $league)
    {
        $userId = Auth::id();

        // Admin cannot leave their own league via this action
        if ($league->admin_id === $userId) {
            return redirect()->route('leagues.index')
                ->with('success', 'League admins cannot leave their own league.');
        }

        $league->participants()->detach($userId);

        return redirect()->route('leagues.index');
    }
}
