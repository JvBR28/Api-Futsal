<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'points',
    ];

    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|unique:teams,name,' . $id,
        ];
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function getTotalGoals()
    {
        $homeGoals = Game::where('house_team_id', $this->id)->sum('score_house_team');
        $awayGoals = Game::where('guest_team_id', $this->id)->sum('score_guest_team');

        return $homeGoals + $awayGoals;
    }
}
