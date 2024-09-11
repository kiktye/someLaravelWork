<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duel extends Model
{
    use HasFactory;

    protected $guarded = null;
    protected $casts = [
        'is_played' => 'boolean'
    ];

    public function teamHome()
    {
        return $this->belongsTo(Team::class, 'team_home_id');
    }

    public function teamAway()
    {
        return $this->belongsTo(Team::class, 'team_away_id');
    }
}
