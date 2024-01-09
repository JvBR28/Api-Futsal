<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::all();
        return response()->json($players);
    }

    public function store(PlayerRequest $request)
    {
        $data = $request->validated();

        $player = Player::create($data);

        return response()->json(['message' => 'Jogador criado com sucesso', 'data' => $player], 201);
    }

    public function update(PlayerRequest $request, $id)
    {
        $player = Player::findOrFail($id);

        $data = $request->validated();

        $player->update($data);

        return response()->json(['message' => 'Jogador atualizado com sucesso', 'data' => $player], 200);
    }

    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return response()->json(['message' => 'Jogador deletado com sucesso'], 200);
    }
}