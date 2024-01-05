<?php

namespace App\Observers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Support\Facades\Log;

class GameObserver
{
    public function creating(Game $game)
    {
        Log::info('GameObserver: creating method called.');
        $this->updateTeamPoints($game);
    }

    public function updated(Game $game)
    {
        Log::info('GameObserver: updated method called.');
        $this->updateTeamPoints($game);
    }

    public function saving(Game $game)
    {
        Log::info('GameObserver: saving method called.');
        $this->checkMinimumPlayers($game);
    }

    protected function updateTeamPoints(Game $game)
    {
        $homeTeam = Team::find($game->house_team_id);
        $guestTeam = Team::find($game->guest_team_id);
    
        $homeTeam->points = 0;
        $guestTeam->points = 0;
    
        if ($game->score_house_team > $game->score_guest_team) 
        {
            $homeTeam->points = 3;
        } 
        elseif ($game->score_house_team < $game->score_guest_team) 
        {
            $guestTeam->points = 3;
        } 
        else 
        {
            $homeTeam->points = 1;
            $guestTeam->points = 1;
        }
    
        $homeTeam->save();
        $guestTeam->save();
    }

    protected function checkMinimumPlayers(Game $game)
    {
        $minPlayers = 5;

        $homeTeamPlayersCount = Team::find($game->house_team_id)->players()->count();
        $guestTeamPlayersCount = Team::find($game->guest_team_id)->players()->count();

        if ($homeTeamPlayersCount < $minPlayers || $guestTeamPlayersCount < $minPlayers) {
            throw new \Exception('Cada time precisa ter pelo menos 5 jogadores para marcar uma partida.');
        }
    }
}