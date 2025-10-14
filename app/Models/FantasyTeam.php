<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FantasyTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_name',
        'players', // JSON string in DB
    ];

    protected $casts = [
        'players' => 'array', // 👈 decode to array automatically
    ];

    // If you want a Collection:
    public function getPlayersCollectionAttribute()
    {
        return collect($this->players ?? []);
    }
}
