<?php

namespace App\Models;

use Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = null;

    public function players()
    {
        return $this->hasMany(Player::class);
    }


    public function matchesAsTeamHome()
    {
        return $this->hasMany(Duel::class, 'team_home_id');
    }

    public function matchesAsTeamAway()
    {
        return $this->hasMany(Duel::class, 'team_away_id');
    }
}
