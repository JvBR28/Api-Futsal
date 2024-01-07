<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'game_start',
        'game_end',
        'house_team_id',
        'guest_team_id',
        'score_house_team',
        'score_guest_team',
    ];

    public static function rules($id = null)
    {
        return [
            'date' => 'required|date',
            'game_start' => 'required|date_format:H:i:s',
            'game_end' => 'required|date_format:H:i:s',
            'house_team_id' => 'required|exists:teams,id',
            'guest_team_id' => 'required|exists:teams,id',
            'score_house_team' => 'required|integer',
            'score_guest_team' => 'required|integer',
        ];
    }

    public function houseTeam()
    {
        return $this->belongsTo(Team::class, 'house_team_id');
    }

    public function guestTeam()
    {
        return $this->belongsTo(Team::class, 'guest_team_id');
    }
}