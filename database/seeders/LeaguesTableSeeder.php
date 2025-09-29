<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LeaguesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure an admin user exists for seeded leagues
        $admin = User::firstOrCreate(
            ['email' => 'leagueadmin@example.com'],
            [
                'name' => 'League Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Ensure there are enough users to populate leagues
        if (User::count() < 6) {
            User::factory(6)->create();
        }

        $allUsers = User::where('id', '!=', $admin->id)->get();

        $leagues = [
            ['name' => 'Global Public League', 'type' => 'public', 'max_participants' => 50],
            ['name' => 'Casual Managers', 'type' => 'public', 'max_participants' => 30],
            ['name' => 'Friends Private League', 'type' => 'private', 'max_participants' => 20],
            ['name' => 'Office Fantasy Cup', 'type' => 'private', 'max_participants' => 40],
        ];

        foreach ($leagues as $config) {
            $league = League::firstOrCreate(
                ['name' => $config['name']],
                [
                    'code' => strtoupper(Str::random(6)),
                    'type' => $config['type'],
                    'admin_id' => $admin->id,
                    'is_public' => $config['type'] === 'public',
                    'max_participants' => $config['max_participants'],
                    'scoring_system' => 'standard',
                ]
            );

            // Attach a random set of participants with points and derived rank
            $take = min(max(3, $allUsers->count()), 10);
            $participants = $allUsers->shuffle()->take($take);

            $rows = [];
            foreach ($participants as $u) {
                $rows[] = ['user' => $u, 'points' => rand(0, 200)];
            }
            usort($rows, function ($a, $b) {
                return $b['points'] <=> $a['points'];
            });

            $rank = 1;
            foreach ($rows as $row) {
                $league->participants()->syncWithoutDetaching([
                    $row['user']->id => ['points' => $row['points'], 'rank' => $rank++],
                ]);
            }
        }
    }
}
