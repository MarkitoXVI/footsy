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
    $myLeagues = auth()->user()->leagues()->with('admin')->get();
    $otherLeagues = League::with('admin')
        ->whereDoesntHave('users', function($q) {
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
                'type' => 'required|in:public,private',
                'league_description' => 'nullable|string|max:500',
                'max_participants' => 'nullable|integer|min:2|max:100',
            ]);

            $code = strtoupper(Str::random(8));

            $league = League::create([
                'name' => $validated['name'],
                'privacy' => $validated['type'],
                'description' => $validated['league_description'] ?? null,
                'max_participants' => $validated['max_participants'] ?? 20,
                'code' => $code,
                'user_id' => auth()->id(),
            ]);

            // ✅ Make the creator also a participant in their league
            $league->users()->attach(auth()->id());

            return redirect()
                ->route('leagues.index')
                ->with('success', 'League created successfully and you have been added as a participant!');
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

    /**
 * Remove the specified league from storage.
 */
public function destroy(League $league)
{
    // Make sure only the admin can delete their own league
    if ($league->user_id !== auth()->id()) {
        return redirect()->route('leagues.index')
            ->with('error', 'You do not have permission to delete this league.');
    }

    $league->delete();

    return redirect()->route('leagues.index')
        ->with('success', 'League deleted successfully!');
}

}
