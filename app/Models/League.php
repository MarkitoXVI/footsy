<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'privacy',
        'max_participants',
        'code',
        'user_id',
    ];

    // 🔹 The admin (creator) of the league
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔹 Many-to-many relation: users participating in this league
    public function users()
    {
        return $this->belongsToMany(User::class, 'league_user')
            ->withPivot('rank')
            ->withTimestamps();
    }

    // 🔹 Alias for clarity — 'participants' = 'users'
    public function participants()
    {
        return $this->users();
    }

    protected static function booted()
{
    static::deleting(function ($league) {
        $league->participants()->detach();
    });
}

}
