<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'type',
        'admin_id',
        'is_public',
        'max_participants',
        'scoring_system',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Get the admin of the league.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get the users participating in the league.
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'league_user')
                    ->withPivot('points', 'rank')
                    ->withTimestamps();
    }

    /**
     * Get the top participants in the league.
     */
    public function topParticipants($limit = 5)
    {
        return $this->participants()->orderBy('rank')->limit($limit)->get();
    }

    /**
     * Check if a user is in the league.
     */
    public function hasUser($userId)
    {
        return $this->participants()->where('user_id', $userId)->exists();
    }
}