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
        $userId = Auth::id();

        $userLeagues = League::with(['admin'])
            ->withCount('participants')
            ->where(function ($q) use ($userId) {
                $q->where('admin_id', $userId)
                  ->orWhereHas('participants', function ($qq) use ($userId) {
                      $qq->where('user_id', $userId);
                  });
            })
            ->orderByDesc('created_at')
            ->get();

        $otherLeagues = League::with(['admin'])
            ->withCount('participants')
            ->where('admin_id', '!=', $userId)
            ->whereDoesntHave('participants', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->orderByDesc('created_at')
            ->get();

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
            'name' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:2|max:100',
            'type' => 'nullable|in:public,private',
            'privacy' => 'nullable|in:public,private',
        ]);

        $type = $validated['type'] ?? $validated['privacy'] ?? 'public';

        $league = League::create([
            'name' => $validated['name'],
            'code' => strtoupper(Str::random(6)),
            'type' => $type,
            'admin_id' => Auth::id(),
            'is_public' => $type === 'public',
            'max_participants' => $validated['max_participants'] ?? null,
            'scoring_system' => 'standard',
        ]);

        // Attach the creator as a participant
        $league->participants()->syncWithoutDetaching([
            Auth::id() => ['points' => 0, 'rank' => 0]
        ]);

        return redirect()->route('leagues.index')
            ->with('success', 'League created successfully! League code: ' . $league->code);
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
