<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $players = [
            // Goalkeepers
            ['name' => 'Alisson Becker', 'team' => 'LIV', 'position' => 'Goalkeeper', 'price' => 6.0, 'points' => 128],
            ['name' => 'David Raya', 'team' => 'ARS', 'position' => 'Goalkeeper', 'price' => 5.0, 'points' => 105],
            ['name' => 'Nick Pope', 'team' => 'NEW', 'position' => 'Goalkeeper', 'price' => 4.5, 'points' => 98],
            ['name' => 'Emiliano Martínez', 'team' => 'AVL', 'position' => 'Goalkeeper', 'price' => 5.5, 'points' => 92],
            ['name' => 'Robert Sánchez', 'team' => 'CHE', 'position' => 'Goalkeeper', 'price' => 5.0, 'points' => 90],
            ['name' => 'Kepa Arrizabalaga', 'team' => 'ARS', 'position' => 'Goalkeeper', 'price' => 5.0, 'points' => 85],
            ['name' => 'Jordan Pickford', 'team' => 'EVE', 'position' => 'Goalkeeper', 'price' => 5.0, 'points' => 80],
            ['name' => 'Illan Meslier', 'team' => 'LEE', 'position' => 'Goalkeeper', 'price' => 4.5, 'points' => 70],
            ['name' => 'Lukasz Fabianski', 'team' => 'WHA', 'position' => 'Goalkeeper', 'price' => 4.5, 'points' => 65],
            ['name' => 'Daniel Iversen', 'team' => 'LEI', 'position' => 'Goalkeeper', 'price' => 4.0, 'points' => 55],

            // Defenders
            ['name' => 'Virgil van Dijk', 'team' => 'LIV', 'position' => 'Defender', 'price' => 6.5, 'points' => 132],
            ['name' => 'Ruben Dias', 'team' => 'MCI', 'position' => 'Defender', 'price' => 6.0, 'points' => 125],
            ['name' => 'William Saliba', 'team' => 'ARS', 'position' => 'Defender', 'price' => 5.5, 'points' => 118],
            ['name' => 'Kieran Trippier', 'team' => 'NEW', 'position' => 'Defender', 'price' => 5.0, 'points' => 112],
            ['name' => 'Ben White', 'team' => 'ARS', 'position' => 'Defender', 'price' => 5.0, 'points' => 108],
            ['name' => 'Andy Robertson', 'team' => 'LIV', 'position' => 'Defender', 'price' => 5.0, 'points' => 105],
            ['name' => 'Gabriel Magalhães', 'team' => 'ARS', 'position' => 'Defender', 'price' => 5.0, 'points' => 100],
            ['name' => 'Luke Shaw', 'team' => 'MUN', 'position' => 'Defender', 'price' => 5.0, 'points' => 85],
            ['name' => 'James Tarkowski', 'team' => 'EVE', 'position' => 'Defender', 'price' => 4.5, 'points' => 70],
            ['name' => 'Tyrone Mings', 'team' => 'AVL', 'position' => 'Defender', 'price' => 4.5, 'points' => 60],
            // New Defenders
            ['name' => 'Reece James', 'team' => 'CHE', 'position' => 'Defender', 'price' => 5.5, 'points' => 90],

            // Midfielders
            ['name' => 'Mohamed Salah', 'team' => 'LIV', 'position' => 'Midfielder', 'price' => 12.5, 'points' => 210],
            ['name' => 'Bruno Fernandes', 'team' => 'MUN', 'position' => 'Midfielder', 'price' => 9.5, 'points' => 168],
            ['name' => 'Bukayo Saka', 'team' => 'ARS', 'position' => 'Midfielder', 'price' => 8.5, 'points' => 155],
            ['name' => 'Martin Ødegaard', 'team' => 'ARS', 'position' => 'Midfielder', 'price' => 8.0, 'points' => 148],
            ['name' => 'James Maddison', 'team' => 'TOT', 'position' => 'Midfielder', 'price' => 7.5, 'points' => 142],
            ['name' => 'Jarrod Bowen', 'team' => 'WHU', 'position' => 'Midfielder', 'price' => 7.5, 'points' => 140],
            ['name' => 'Andreas Pereira', 'team' => 'FUL', 'position' => 'Midfielder', 'price' => 5.5, 'points' => 90],
            ['name' => 'Jacob Ramsey', 'team' => 'AVL', 'position' => 'Midfielder', 'price' => 5.5, 'points' => 85],
            ['name' => 'Harvey Barnes', 'team' => 'NEW', 'position' => 'Midfielder', 'price' => 6.0, 'points' => 95],
            ['name' => 'Emile Smith Rowe', 'team' => 'FUL', 'position' => 'Midfielder', 'price' => 6.0, 'points' => 100],
            ['name' => 'Eberechi Eze', 'team' => 'ARS', 'position' => 'Midfielder', 'price' => 5.5, 'points' => 70],
            // New Midfielders
            ['name' => 'Phil Foden', 'team' => 'MCI', 'position' => 'Midfielder', 'price' => 8.0, 'points' => 120],

            // Forwards
            ['name' => 'Erling Haaland', 'team' => 'MCI', 'position' => 'Forward', 'price' => 14.0, 'points' => 245],
            ['name' => 'Ollie Watkins', 'team' => 'AVL', 'position' => 'Forward', 'price' => 8.0, 'points' => 158],
            ['name' => 'Gabriel Jesus', 'team' => 'ARS', 'position' => 'Forward', 'price' => 7.5, 'points' => 152],
            ['name' => 'Alexander Isak', 'team' => 'LIV', 'position' => 'Forward', 'price' => 6.5, 'points' => 130],
            ['name' => 'Callum Wilson', 'team' => 'WHU', 'position' => 'Forward', 'price' => 6.5, 'points' => 115],
            ['name' => 'Cameron Archer', 'team' => 'AVL', 'position' => 'Forward', 'price' => 5.0, 'points' => 80],
        ];

        foreach ($players as $player) {
            Player::create($player);
        }
    }
}
