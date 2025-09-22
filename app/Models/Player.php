<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'first_name',
        'last_name',
        'position',
        'jersey_number',
        'price',
        'total_points',
        'form',
        'points_per_game',
        'minutes_played',
        'goals_scored',
        'assists',
        'clean_sheets',
        'yellow_cards',
        'red_cards',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'form' => 'decimal:1',
        'points_per_game' => 'decimal:1',
    ];

    /**
     * Get the team that the player belongs to.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the fantasy teams that include this player.
     */
    public function fantasyTeams()
    {
        return $this->belongsToMany(FantasyTeam::class, 'fantasy_team_player')
                    ->withPivot('is_captain', 'is_vice_captain', 'position')
                    ->withTimestamps();
    }

    /**
     * Get the player's full name.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the player's fixtures.
     */
    public function fixtures()
    {
        return $this->hasManyThrough(Fixture::class, Team::class, 'id', 'home_team_id', 'team_id', 'id')
                    ->orHasManyThrough(Fixture::class, Team::class, 'id', 'away_team_id', 'team_id', 'id');
    }

    /**
     * Scope a query to only include players of a given position.
     */
    public function scopeByPosition($query, $position)
    {
        return $query->where('position', $position);
    }

    /**
     * Scope a query to only include players from a given team.
     */
    public function scopeByTeam($query, $teamId)
    {
        return $query->where('team_id', $teamId);
    }
}