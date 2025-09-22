<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fantasy_team_id',
        'player_in_id',
        'player_out_id',
        'gameweek',
        'is_wildcard',
        'is_free_hit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_wildcard' => 'boolean',
        'is_free_hit' => 'boolean',
    ];

    /**
     * Get the fantasy team that made the transfer.
     */
    public function fantasyTeam()
    {
        return $this->belongsTo(FantasyTeam::class);
    }

    /**
     * Get the player coming in.
     */
    public function playerIn()
    {
        return $this->belongsTo(Player::class, 'player_in_id');
    }

    /**
     * Get the player going out.
     */
    public function playerOut()
    {
        return $this->belongsTo(Player::class, 'player_out_id');
    }

    /**
     * Scope a query to only include transfers for a specific gameweek.
     */
    public function scopeByGameweek($query, $gameweek)
    {
        return $query->where('gameweek', $gameweek);
    }

    /**
     * Scope a query to only include wildcard transfers.
     */
    public function scopeWildcard($query)
    {
        return $query->where('is_wildcard', true);
    }
}