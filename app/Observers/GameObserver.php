<?php

namespace App\Observers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Support\Facades\Log;

class GameObserver
{
    public function updated(Game $game)
    {
        Log::info('GameObserver: updated method called.');
        $homeTeam = Team::find($game->house_team_id);
        $guestTeam = Team::find($game->guest_team_id);

        if ($game->score_house_team > $game->score_guest_team) 
        {
            $homeTeam->points += 3;
        } 
        elseif ($game->score_house_team < $game->score_guest_team) 
        {
            $guestTeam->points += 3;
        } 
        else 
        {
            $homeTeam->points += 1;
            $guestTeam->points += 1;
        }

        $homeTeam->save();
        $guestTeam->save();
    }
}