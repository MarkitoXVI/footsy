<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\Team;
use App\Services\FPLService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncFPLData extends Command
{
    protected $signature = 'fpl:sync';
    protected $description = 'Sync Teams & Players from FPL bootstrap-static';

    public function handle(FPLService $fpl)
    {
        $this->info('Fetching bootstrap data...');
        $teams = $fpl->teams();
        $elements = $fpl->elements();

        DB::transaction(function () use ($teams, $elements) {
            // Index teams by fpl_id for quick lookup
            $this->info('Syncing teams...');
            $teamIdByFpl = [];
            foreach ($teams as $t) {
                $team = Team::updateOrCreate(
                    ['fpl_id' => $t['id']],
                    [
                        'name' => $t['name'],
                        'short_name' => $t['short_name'],
                        'code' => $t['code'],
                        'strength' => $t['strength'],
                        'strength_overall_home' => $t['strength_overall_home'],
                        'strength_overall_away' => $t['strength_overall_away'],
                        'strength_attack_home' => $t['strength_attack_home'],
                        'strength_attack_away' => $t['strength_attack_away'],
                        'strength_defence_home' => $t['strength_defence_home'],
                        'strength_defence_away' => $t['strength_defence_away'],
                    ]
                );
                $teamIdByFpl[$t['id']] = $team->id;
            }

            $this->info('Syncing players...');
            foreach ($elements as $p) {
                $localTeamId = $teamIdByFpl[$p['team']] ?? null;
                if (!$localTeamId) continue; // skip if unknown team

                Player::updateOrCreate(
                    ['fpl_id' => $p['id']],
                    [
                        'code' => $p['code'],
                        'team_id' => $localTeamId,
                        'element_type' => $p['element_type'],
                        'first_name' => $p['first_name'],
                        'second_name' => $p['second_name'],
                        'web_name' => $p['web_name'],
                        'price' => $p['now_cost'] / 10,
                        'form' => (float)$p['form'],
                        'points_per_game' => $p['points_per_game'],
                        'total_points' => $p['total_points'],
                        'minutes' => $p['minutes'],
                        'goals_scored' => $p['goals_scored'],
                        'assists' => $p['assists'],
                        'clean_sheets' => $p['clean_sheets'],
                        'yellow_cards' => $p['yellow_cards'],
                        'red_cards' => $p['red_cards'],
                        'status' => $p['status'],
                        'news' => $p['news'] ?: null,
                        'photo' => $p['photo'] ?: null,
                    ]
                );
            }
        });

        $this->info('FPL sync complete ✅');
        return self::SUCCESS;
    }
}
