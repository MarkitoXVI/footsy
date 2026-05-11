<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FantasyTeam;
use App\Models\Transfer;
use App\Models\Player;

class TransferController extends Controller
{
    /**
     * Show transfers page
     */
    public function index()
    {
        $user = Auth::user();

        $fantasyTeam = FantasyTeam::with('players')
            ->where('user_id', $user->id)
            ->first();

        $currentGameweek = 1; // replace with your GW logic
        $freeTransfers = 1;

        return view('transfers.index', compact(
            'fantasyTeam',
            'currentGameweek',
            'freeTransfers'
        ));
    }

    /**
     * Confirm transfers
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'transfers' => 'required|array|min:1',
            'transfers.*.element_in' => 'required|integer',
            'transfers.*.element_out' => 'required|integer',
            'transfers.*.purchase_price' => 'required|integer',
            'transfers.*.selling_price' => 'required|integer',
        ]);

        $user = Auth::user();

        $team = FantasyTeam::where('user_id', $user->id)->first();

        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        DB::beginTransaction();

        try {
            foreach ($request->transfers as $t) {

                // Get player records (assuming you store them in DB)
                $outPlayer = Player::find($t['element_out']);
                $inPlayer  = Player::find($t['element_in']);

                if (!$outPlayer || !$inPlayer) {
                    throw new \Exception("Invalid player in transfer");
                }

                // REMOVE OUT PLAYER FROM TEAM
                $team->players()->detach($outPlayer->id);

                // ADD IN PLAYER TO TEAM
                $team->players()->attach($inPlayer->id);

                // OPTIONAL: store transfer history
                Transfer::create([
                    'fantasy_team_id' => $team->id,
                    'player_out_id'   => $outPlayer->id,
                    'player_in_id'    => $inPlayer->id,
                    'price_out'       => $t['selling_price'],
                    'price_in'        => $t['purchase_price'],
                ]);
            }

            // Update budget
            $totalChange = collect($request->transfers)
                ->sum(fn($t) => $t['selling_price'] - $t['purchase_price']);

            $team->remaining_budget += ($totalChange / 10); // convert back to M if needed
            $team->save();

            DB::commit();

            return response()->json([
                'message' => 'Transfers confirmed successfully'
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}