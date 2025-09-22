<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'gameweek',
        'kickoff_time',
        'venue'
    ];

    // If you want to use "match_date" as an alias in your code
    public function getMatchDateAttribute()
    {
        return $this->kickoff_time;
    }

    /**
     * Get the home team.
     */
    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    /**
     * Get the away team.
     */
    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    /**
     * Scope a query to only include upcoming fixtures.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('kickoff_time', '>=', now())
                    ->orderBy('kickoff_time', 'asc');
    }

    /**
     * Scope a query to only include past fixtures.
     */
    public function scopePast($query)
    {
        return $query->where('kickoff_time', '<', now())
                    ->orderBy('kickoff_time', 'desc');
    }
}