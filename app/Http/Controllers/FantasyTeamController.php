<?php

namespace App\Http\Controllers;

use App\Models\FantasyTeam;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FantasyTeamController extends Controller
{
    /**
     * Parāda resursa sarakstu.
     */
    public function index()
    {
        $user = Auth::user();
        $fantasyTeam = FantasyTeam::where('user_id', $user->id)
            ->with(['players.team']) // Eager load players and their teams
            ->first();

        return view('fantasy-team.index', compact('fantasyTeam'));
    }

    /**
     * Parāda formu jauna resursa izveidei.
     */
    public function create()
    {
        $players = Player::all()->groupBy('position');
        return view('fantasy-team.create', compact('players'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Team creation request received', $request->all());
        
        DB::beginTransaction();
        
        try {
            $user = Auth::user();
            
            // Check if user already has a team
            $existingTeam = FantasyTeam::where('user_id', $user->id)->first();
            if ($existingTeam) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already have a fantasy team!'
                ], 400);
            }

            // Validate the request
            $validated = $request->validate([
                'team_name' => 'required|string|max:255',
                'formation' => 'required|string',
                'players' => 'required|array',
                'total_budget' => 'required|numeric',
                'spent_budget' => 'required|numeric'
            ]);

            // Create the fantasy team
            $fantasyTeam = FantasyTeam::create([
                'user_id' => $user->id,
                'team_name' => $validated['team_name'],
                'formation' => $validated['formation'],
                'total_budget' => $validated['total_budget'],
                'spent_budget' => $validated['spent_budget'],
                'remaining_budget' => $validated['total_budget'] - $validated['spent_budget']
            ]);

            // Attach players to the team
            $this->attachPlayersToTeam($fantasyTeam, $validated['players']);

            DB::commit();

            Log::info('Team created successfully', ['team_id' => $fantasyTeam->id]);

            return response()->json([
                'success' => true,
                'message' => 'Team created successfully!',
                'team_id' => $fantasyTeam->id,
                'redirect_url' => route('fantasy-team.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create team: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create team: ' . $e->getMessage()
            ], 500);
        }
    }

    private function attachPlayersToTeam($fantasyTeam, $playersData)
    {
        $playerData = [];
        
        // Starting goalkeeper
        if (!empty($playersData['goalkeeper'])) {
            $playerData[$playersData['goalkeeper']] = [
                'is_substitute' => false,
                'position_order' => 1
            ];
        }
        
        // Defenders
        if (!empty($playersData['defenders'])) {
            foreach ($playersData['defenders'] as $index => $defenderId) {
                if (!empty($defenderId)) {
                    $playerData[$defenderId] = [
                        'is_substitute' => false,
                        'position_order' => 2 + $index
                    ];
                }
            }
        }
        
        // Midfielders
        if (!empty($playersData['midfielders'])) {
            foreach ($playersData['midfielders'] as $index => $midfielderId) {
                if (!empty($midfielderId)) {
                    $playerData[$midfielderId] = [
                        'is_substitute' => false,
                        'position_order' => 2 + count($playersData['defenders'] ?? []) + $index
                    ];
                }
            }
        }
        
        // Forwards
        if (!empty($playersData['forwards'])) {
            foreach ($playersData['forwards'] as $index => $forwardId) {
                if (!empty($forwardId)) {
                    $playerData[$forwardId] = [
                        'is_substitute' => false,
                        'position_order' => 2 + count($playersData['defenders'] ?? []) + count($playersData['midfielders'] ?? []) + $index
                    ];
                }
            }
        }
        
        // Substitutes
        $substituteOrder = 1;
        if (!empty($playersData['substitutes'])) {
            foreach ($playersData['substitutes'] as $substituteId) {
                if (!empty($substituteId)) {
                    $playerData[$substituteId] = [
                        'is_substitute' => true,
                        'position_order' => $substituteOrder++
                    ];
                }
            }
        }

        // Attach players with additional data
        if (!empty($playerData)) {
            $fantasyTeam->players()->attach($playerData);
        }
    }
}