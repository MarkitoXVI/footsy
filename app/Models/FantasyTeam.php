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
        'budget',
        'players', // JSON field
    ];

    protected $casts = [
        'players' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPlayersCollectionAttribute()
    {
        return collect($this->players ?? []);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'fantasy_team_player')
            ->withPivot(['is_starter', 'position'])
            ->withTimestamps();
    }

}
