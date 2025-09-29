<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FantasyTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_name',
        'formation',
        'total_budget',
        'spent_budget',
        'remaining_budget',
        'total_points'
    ];

    /**
     * Get the user that owns the fantasy team.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The players that belong to the fantasy team.
     */
public function players()
{
    return $this->belongsToMany(Player::class, 'fantasy_team_players')
                ->withPivot(['is_substitute', 'position_order'])
                ->withTimestamps();
}

    /**
     * Get the captain of the team.
     */
    public function captain()
    {
        return $this->players()->wherePivot('is_captain', true)->first();
    }
}