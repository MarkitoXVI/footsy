<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'), // Add a default password
            ]
        );

        // Call the PlayersTableSeeder and LeaguesTableSeeder to seed data
        $this->call([
            PlayersTableSeeder::class,
            LeaguesTableSeeder::class,
        ]);
    }
}
