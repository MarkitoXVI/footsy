<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerPerformance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'player_id',
        'fixture_id',
        'minutes_played',
        'goals_scored',
        'assists',
        'clean_sheet',
        'goals_conceded',
        'own_goals',
        'penalties_saved',
        'penalties_missed',
        'yellow_cards',
        'red_cards',
        'saves',
        'bonus_points',
        'total_points',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'clean_sheet' => 'boolean',
    ];

    /**
     * Get the player.
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the fixture.
     */
    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }

    /**
     * Calculate the total points for the performance.
     */
    public function calculatePoints()
    {
        $points = 0;

        // Points for playing
        if ($this->minutes_played > 0) {
            $points += 1;
            if ($this->minutes_played >= 60) {
                $points += 1; // Additional point for playing 60+ minutes
            }
        }

        // Points for goals
        if ($this->player->position === 'Goalkeeper' || $this->player->position === 'Defender') {
            $points += $this->goals_scored * 6;
        } elseif ($this->player->position === 'Midfielder') {
            $points += $this->goals_scored * 5;
        } else { // Forward
            $points += $this->goals_scored * 4;
        }

        // Points for assists
        $points += $this->assists * 3;

        // Points for clean sheet (only if played at least 60 minutes)
        if ($this->clean_sheet && $this->minutes_played >= 60) {
            if ($this->player->position === 'Goalkeeper' || $this->player->position === 'Defender') {
                $points += 4;
            } elseif ($this->player->position === 'Midfielder') {
                $points += 1;
            }
        }

        // Points for saves (goalkeepers only)
        if ($this->player->position === 'Goalkeeper') {
            $points += floor($this->saves / 3);
        }

        // Deductions for goals conceded (goalkeepers and defenders only)
        if (($this->player->position === 'Goalkeeper' || $this->player->position === 'Defender') && $this->minutes_played >= 60) {
            $points -= floor($this->goals_conceded / 2);
        }

        // Deductions for cards and missed penalties
        $points -= $this->yellow_cards;
        $points -= $this->red_cards * 3;
        $points -= $this->penalties_missed * 2;
        $points -= $this->own_goals * 2;

        // Points for penalties saved (goalkeepers only)
        if ($this->player->position === 'Goalkeeper') {
            $points += $this->penalties_saved * 5;
        }

        // Bonus points
        $points += $this->bonus_points;

        return $points;
    }
}