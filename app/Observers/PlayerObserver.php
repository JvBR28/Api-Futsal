<?php

namespace App\Observers;

use App\Models\Player;

class PlayerObserver
{
    public function creating(Player $player)
    {
        $this->checkShirtNumber($player);
    }

    public function updating(Player $player)
    {
        $this->checkShirtNumber($player);
    }

    protected function checkShirtNumber(Player $player)
    {
        $existingPlayer = Player::where('shirt_number', $player->shirt_number)
            ->where('team_id', $player->team_id)
            ->first();

        if ($existingPlayer && $existingPlayer->id !== $player->id) {
            throw new \Exception('O número da camisa já está em uso por outro jogador do mesmo time.');
        }
    }
}
