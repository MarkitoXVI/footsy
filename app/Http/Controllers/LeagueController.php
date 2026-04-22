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

        $participants = $league->participants;

        return view('leagues.show', compact('league', 'participants'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Load all leagues the user is in + pivot data (is_admin + rank)
        $myLeagues = $user->leagues()
            ->with('admin')
            ->withPivot('is_admin', 'rank')
            ->get();

        // Split into admin vs participant leagues (this fixes the empty state)
        $adminLeagues      = $myLeagues->where('pivot.is_admin', true);
        $participantLeagues = $myLeagues->where('pivot.is_admin', false);

        // Other leagues the user has NOT joined yet
        $otherLeagues = League::with('admin')
            ->whereDoesntHave('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->get();

        return view('leagues.index', compact('adminLeagues', 'participantLeagues', 'otherLeagues'));
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
            'name'                => 'required|string|max:255',
            'type'                => 'required|in:public,private',
            'league_description'  => 'nullable|string|max:500',
            'max_participants'    => 'nullable|integer|min:2|max:100',
        ]);

        $code = strtoupper(Str::random(8));

        $league = League::create([
            'name'             => $validated['name'],
            'privacy'          => $validated['type'],
            'description'      => $validated['league_description'] ?? null,
            'max_participants' => $validated['max_participants'] ?? 20,
            'code'             => $code,
            'user_id'          => auth()->id(),
        ]);

        // ✅ FIXED: Creator is now properly added as ADMIN
        $league->users()->attach(auth()->id(), ['is_admin' => true]);

        return redirect()
            ->route('leagues.index')
            ->with('success', 'League created successfully!');
    }

    /**
     * Join a league.
     */
    public function join($id)
    {
        $league = League::findOrFail($id);

        if (! $league->users()->where('user_id', auth()->id())->exists()) {
            $league->users()->attach(auth()->id());
        }

        return redirect()
            ->route('leagues.index')
            ->with('success', 'Successfully joined "' . $league->name . '"!');
    }

    /**
     * Leave a league.
     */
    public function leave(League $league)
    {
        $userId = Auth::id();

        // Admin cannot leave their own league
        if ($league->user_id === $userId) {
            return redirect()
                ->route('leagues.index')
                ->with('error', 'League admins cannot leave their own league.');
        }

        $league->users()->detach($userId);

        return redirect()
            ->route('leagues.index')
            ->with('success', 'You have left the league.');
    }

    /**
     * Remove the specified league from storage.
     */
    public function destroy(League $league)
    {
        if ($league->user_id !== auth()->id()) {
            return redirect()->route('leagues.index')
                ->with('error', 'You do not have permission to delete this league.');
        }

        $league->delete();

        return redirect()->route('leagues.index')
            ->with('success', 'League deleted successfully!');
    }
}