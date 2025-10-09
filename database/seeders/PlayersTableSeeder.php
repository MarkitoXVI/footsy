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
        ['id' => 1, 'name' => 'Alisson Becker', 'team' => 'LIV', 'position' => 'Goalkeeper', 'price' => 6.0, 'points' => 128],
        ['id' => 3, 'name' => 'David Raya', 'team' => 'ARS', 'position' => 'Goalkeeper', 'price' => 5.0, 'points' => 105],
        ['id' => 4, 'name' => 'Nick Pope', 'team' => 'NEW', 'position' => 'Goalkeeper', 'price' => 4.5, 'points' => 98],
        ['id' => 5, 'name' => 'Emiliano Martínez', 'team' => 'AVL', 'position' => 'Goalkeeper', 'price' => 5.5, 'points' => 92],
        ['id' => 26, 'name' => 'Robert Sánchez', 'team' => 'CHE', 'position' => 'Goalkeeper', 'price' => 5.0, 'points' => 90],
        ['id' => 27, 'name' => 'Kepa Arrizabalaga', 'team' => 'ARS', 'position' => 'Goalkeeper', 'price' => 5.0, 'points' => 85],
        ['id' => 28, 'name' => 'Jordan Pickford', 'team' => 'EVE', 'position' => 'Goalkeeper', 'price' => 5.0, 'points' => 80],
        ['id' => 31, 'name' => 'Illan Meslier', 'team' => 'LEE', 'position' => 'Goalkeeper', 'price' => 4.5, 'points' => 70],
        ['id' => 32, 'name' => 'Lukasz Fabianski', 'team' => 'WHA', 'position' => 'Goalkeeper', 'price' => 4.5, 'points' => 65],
        ['id' => 2, 'name' => 'Daniel Iversen', 'team' => 'LEI', 'position' => 'Goalkeeper', 'price' => 4.0, 'points' => 55],

        // Defenders
        ['id' => 7, 'name' => 'Virgil van Dijk', 'team' => 'LIV', 'position' => 'Defender', 'price' => 6.5, 'points' => 132],
        ['id' => 8, 'name' => 'Ruben Dias', 'team' => 'MCI', 'position' => 'Defender', 'price' => 6.0, 'points' => 125],
        ['id' => 9, 'name' => 'William Saliba', 'team' => 'ARS', 'position' => 'Defender', 'price' => 5.5, 'points' => 118],
        ['id' => 10, 'name' => 'Kieran Trippier', 'team' => 'NEW', 'position' => 'Defender', 'price' => 5.0, 'points' => 112],
        ['id' => 11, 'name' => 'Ben White', 'team' => 'ARS', 'position' => 'Defender', 'price' => 5.0, 'points' => 108],
        ['id' => 12, 'name' => 'Andy Robertson', 'team' => 'LIV', 'position' => 'Defender', 'price' => 5.0, 'points' => 105],
        ['id' => 30, 'name' => 'Gabriel Magalhães', 'team' => 'ARS', 'position' => 'Defender', 'price' => 5.0, 'points' => 100],
        ['id' => 34, 'name' => 'Luke Shaw', 'team' => 'MUN', 'position' => 'Defender', 'price' => 5.0, 'points' => 85],
        ['id' => 37, 'name' => 'James Tarkowski', 'team' => 'EVE', 'position' => 'Defender', 'price' => 4.5, 'points' => 70],
        ['id' => 39, 'name' => 'Tyrone Mings', 'team' => 'AVL', 'position' => 'Defender', 'price' => 4.5, 'points' => 60],
        // New Defender
        ['id' => 43, 'name' => 'Reece James', 'team' => 'CHE', 'position' => 'Defender', 'price' => 5.5, 'points' => 90],

        // Midfielders
        ['id' => 14, 'name' => 'Mohamed Salah', 'team' => 'LIV', 'position' => 'Midfielder', 'price' => 12.5, 'points' => 210],
        ['id' => 15, 'name' => 'Bruno Fernandes', 'team' => 'MUN', 'position' => 'Midfielder', 'price' => 9.5, 'points' => 168],
        ['id' => 16, 'name' => 'Bukayo Saka', 'team' => 'ARS', 'position' => 'Midfielder', 'price' => 8.5, 'points' => 155],
        ['id' => 18, 'name' => 'Martin Ødegaard', 'team' => 'ARS', 'position' => 'Midfielder', 'price' => 8.0, 'points' => 148],
        ['id' => 19, 'name' => 'James Maddison', 'team' => 'TOT', 'position' => 'Midfielder', 'price' => 7.5, 'points' => 142],
        ['id' => 21, 'name' => 'Jarrod Bowen', 'team' => 'WHU', 'position' => 'Midfielder', 'price' => 7.5, 'points' => 140],
        ['id' => 33, 'name' => 'Andreas Pereira', 'team' => 'FUL', 'position' => 'Midfielder', 'price' => 5.5, 'points' => 90],
        ['id' => 36, 'name' => 'Jacob Ramsey', 'team' => 'AVL', 'position' => 'Midfielder', 'price' => 5.5, 'points' => 85],
        ['id' => 41, 'name' => 'Harvey Barnes', 'team' => 'NEW', 'position' => 'Midfielder', 'price' => 6.0, 'points' => 95],
        ['id' => 42, 'name' => 'Emile Smith Rowe', 'team' => 'FUL', 'position' => 'Midfielder', 'price' => 6.0, 'points' => 100],
        ['id' => 44, 'name' => 'Eberechi Eze', 'team' => 'ARS', 'position' => 'Midfielder', 'price' => 5.5, 'points' => 70],
        // New Midfielder
        ['id' => 45, 'name' => 'Phil Foden', 'team' => 'MCI', 'position' => 'Midfielder', 'price' => 8.0, 'points' => 120],

        // Forwards
        ['id' => 20, 'name' => 'Erling Haaland', 'team' => 'MCI', 'position' => 'Forward', 'price' => 14.0, 'points' => 245],
        ['id' => 23, 'name' => 'Ollie Watkins', 'team' => 'AVL', 'position' => 'Forward', 'price' => 8.0, 'points' => 158],
        ['id' => 24, 'name' => 'Gabriel Jesus', 'team' => 'ARS', 'position' => 'Forward', 'price' => 7.5, 'points' => 152],
        ['id' => 29, 'name' => 'Alexander Isak', 'team' => 'LIV', 'position' => 'Forward', 'price' => 6.5, 'points' => 130],
        ['id' => 35, 'name' => 'Callum Wilson', 'team' => 'WHU', 'position' => 'Forward', 'price' => 6.5, 'points' => 115],
        ['id' => 40, 'name' => 'Cameron Archer', 'team' => 'AVL', 'position' => 'Forward', 'price' => 5.0, 'points' => 80],
    ];

        foreach ($players as $p) {
        \App\Models\Player::updateOrCreate(['id' => $p['id']], $p);
    }
}
}
