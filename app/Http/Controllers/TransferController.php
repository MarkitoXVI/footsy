<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FantasyTeam;
use App\Models\Player;

class TransferController extends Controller
{
    /**
     * Show transfer page for user’s team
     */
    public function confirm(Request $request)
{
    $validated = $request->validate([
        'transfers'              => 'required|array|min:1',
        'transfers.*.element_in'     => 'required|integer',
        'transfers.*.element_out'    => 'required|integer',
        'transfers.*.purchase_price' => 'required|integer',
        'transfers.*.selling_price'  => 'required|integer',
    ]);

    $fantasyTeam = auth()->user()->fantasyTeam;

    foreach ($validated['transfers'] as $transfer) {
        // Apply budget change
        $priceDiff = ($transfer['purchase_price'] - $transfer['selling_price']) / 10;
        $fantasyTeam->remaining_budget -= $priceDiff;

        // Swap players (adjust to match your data structure)
        $players = collect($fantasyTeam->players);
        $fantasyTeam->players = $players->map(function ($p) use ($transfer) {
            if (($p['id'] ?? null) == $transfer['element_out']) {
                // Replace with incoming player data — fetch from your DB or FPL cache
                return array_merge($p, ['id' => $transfer['element_in']]);
            }
            return $p;
        })->values()->all();
    }

    $fantasyTeam->save();

    return response()->json(['message' => 'Transfers confirmed']);
}
}