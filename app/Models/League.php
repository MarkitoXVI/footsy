<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code',
        'privacy',
        'description',
        'user_id', // admin (creator) of the league
    ];

    /**
     * Relationships
     */

    // The admin (creator) of the league
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // The users participating in the league (many-to-many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'league_user')
                    ->withPivot('points', 'rank')
                    ->withTimestamps();
    }

    /**
     * Accessors / Helper Methods
     */

    // Get top participants
    public function topParticipants($limit = 5)
    {
        return $this->users()->orderBy('pivot_rank')->limit($limit)->get();
    }

    // Check if a user is already in this league
    public function hasUser($userId)
    {
        return $this->users()->where('user_id', $userId)->exists();
    }

    // Automatically generate a random join code if missing
    protected static function booted()
    {
        static::creating(function ($league) {
            if (empty($league->code)) {
                $league->code = strtoupper(substr(md5(uniqid()), 0, 8));
            }
        });
    }
}
