<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_name',
        'code',
        'strength',
        'strength_overall_home',
        'strength_overall_away',
        'strength_attack_home',
        'strength_attack_away',
        'strength_defense_home',
        'strength_defense_away',
    ];

    /**
     * Get the players for the team.
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    /**
     * Get the home fixtures for the team.
     */
    public function homeFixtures()
    {
        return $this->hasMany(Fixture::class, 'home_team_id');
    }

    /**
     * Get the away fixtures for the team.
     */
    public function awayFixtures()
    {
        return $this->hasMany(Fixture::class, 'away_team_id');
    }

    /**
     * Get all fixtures for the team.
     */
    public function fixtures()
    {
        return $this->homeFixtures->merge($this->awayFixtures);
    }
}