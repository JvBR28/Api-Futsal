<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        return response()->json(Player::all());
    }

    public function store(PlayerRequest $request)
    {
        $data = $request->validated();

        $player = Player::create($data);

        return ReturnApi::Success('Jogador criado com sucesso', $player, 201);
    }

    public function update(PlayerRequest $request, $id)
    {
        $player = Player::findOrFail($id);

        $data = $request->validated();

        $player->update($data);

        return ReturnApi::Success('Jogador atualizado com sucesso', $player);
    }

    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return ReturnApi::Success('Jogador deletado com sucesso', $player);
    }
}