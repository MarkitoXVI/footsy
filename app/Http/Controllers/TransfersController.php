<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FantasyTeam;
use App\Models\Player;

class TransfersController extends Controller
{
    /**
     * Show transfer page for user’s team
     */
    public function index()
    {
        $fantasyTeam = FantasyTeam::with('players')->where('user_id', Auth::id())->first();

        if (!$fantasyTeam) {
            return redirect()->route('fantasy-team.index')
                ->with('error', 'You must create a team before making transfers.');
        }

        // Get all player IDs already in this team
        $currentPlayerIds = $fantasyTeam->players->pluck('id')->toArray();

        // Show all players except ones already in team
        $availablePlayers = Player::whereNotIn('id', $currentPlayerIds)->get();

        return view('transfers.index', compact('fantasyTeam', 'availablePlayers'));
    }

    /**
     * Handle transfers
     */
    public function makeTransfer(Request $request, $teamId)
    {
        $team = FantasyTeam::with('players')->findOrFail($teamId);

        if ($team->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized transfer attempt.'
            ], 403);
        }

        $transfers = $request->input('transfers', []);

        if (empty($transfers)) {
            return response()->json([
                'success' => false,
                'message' => 'No transfers submitted.'
            ], 400);
        }

        // Keep track of current players
        $currentPlayerIds = $team->players->pluck('id')->toArray();
        $spentBudget = $team->spent_budget;

        foreach ($transfers as $transfer) {
            $outId = $transfer['outId'] ?? null;
            $inId  = $transfer['inId'] ?? null;

            if (!$outId || !$inId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid transfer request.'
                ], 400);
            }

            // Prevent duplicate players
            if (in_array($inId, $currentPlayerIds)) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already own this player.'
                ], 400);
            }

            $outPlayer = Player::find($outId);
            $inPlayer  = Player::find($inId);

            if (!$outPlayer || !$inPlayer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid players selected.'
                ], 400);
            }

            // Check position (optional rule: only swap same position)
            if ($outPlayer->position !== $inPlayer->position) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transfers must be like-for-like (same position).'
                ], 400);
            }

            // Budget check
            $newSpent = $spentBudget - $outPlayer->price + $inPlayer->price;
            if ($newSpent > $team->total_budget) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough budget for this transfer.'
                ], 400);
            }

            // Perform the swap
            $team->players()->detach($outPlayer->id);
            $team->players()->attach($inPlayer->id, [
                'is_substitute' => false, // default, or inherit?
                'position_order' => 0
            ]);

            // Update spent budget
            $spentBudget = $newSpent;

            // Update current players list
            $currentPlayerIds = array_diff($currentPlayerIds, [$outPlayer->id]);
            $currentPlayerIds[] = $inPlayer->id;
        }

        // Save updated budget
        $team->spent_budget = $spentBudget;
        $team->remaining_budget = $team->total_budget - $spentBudget;
        $team->save();

        return response()->json([
            'success' => true,
            'message' => 'Transfers completed successfully!',
            'redirect_url' => route('fantasy-team.index')
        ]);
    }
}
