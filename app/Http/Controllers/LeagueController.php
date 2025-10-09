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
        // Fetch leagues created by the logged-in user
        $myLeagues = League::with('user')
            ->withCount('participants')
            ->where('user_id', Auth::id())
            ->get();

        // Fetch public leagues not created by the user
        $otherLeagues = League::with('user')
            ->withCount('participants')
            ->where('privacy', 'public')
            ->where('user_id', '!=', Auth::id())
            ->get();

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
    public function join(League $league)
    {
        $userId = Auth::id();

        // Prevent joining twice and admin self-join
        $alreadyMember = $league->participants()->where('user_id', $userId)->exists();
        if (!$alreadyMember && $league->admin_id !== $userId) {
            // Respect capacity if set
            if ($league->max_participants && ($league->participants()->count() + 1) > $league->max_participants) {
                return redirect()->route('leagues.index')->with('success', 'League is full.');
            }

            $league->participants()->attach($userId, ['points' => 0, 'rank' => 0]);
        }

        return redirect()->route('leagues.index');
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
