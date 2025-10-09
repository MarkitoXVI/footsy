<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixtureEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'fixture_id', 'team_id', 'player_id', 'player_name', 'type', 'minute', 'extra_minute', 'description'
    ];

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
