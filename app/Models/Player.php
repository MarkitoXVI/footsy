<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'fpl_id','code','team_id','element_type','first_name','second_name','web_name',
        'price','form','points_per_game','total_points','minutes',
        'goals_scored','assists','clean_sheets','yellow_cards','red_cards',
        'status','news','photo'
    ];

    protected $appends = ['full_name','photo_url','position_label'];

    public function team(){ return $this->belongsTo(Team::class); }

    public function fantasyTeams()
{
    return $this->belongsToMany(FantasyTeam::class, 'fantasy_team_player');
}


    public function getFullNameAttribute(){ return "{$this->first_name} {$this->second_name}"; }

    public function getPhotoUrlAttribute()
    {
        // FPL images pattern: strip ".jpg" and prepend "p"
        // Example: photo "12345.jpg" => .../p12345.png (or .jpg; png is common)
        if(!$this->photo) return null;
        $slug = pathinfo($this->photo, PATHINFO_FILENAME);
        return "https://resources.premierleague.com/premierleague/photos/players/110x140/p{$slug}.png";
    }

    public function getPositionLabelAttribute()
    {
        return [1=>'GKP',2=>'DEF',3=>'MID',4=>'FWD'][$this->element_type] ?? 'UNK';
    }
}
