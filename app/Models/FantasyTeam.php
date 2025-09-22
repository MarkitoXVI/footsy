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
        'name',
        'user_id',
        'budget',
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
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)
                    ->withPivot('is_captain')
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