<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return response()->json(Game::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate(Game::rules());

        $games = Game::create($data);

        return ReturnApi::Success('Partida criada com sucesso', $games, 201);
    }

    public function update(Request $request, $id)
    {
        $games = Game::findOrFail($id);

        $data = $request->validate(Game::rules());

        $games->update($data);

        return ReturnApi::Success('Partida atualizada com sucesso', $games);
    }

    public function destroy($id)
    {
        $games = Game::findOrFail($id);
        $games->delete();

        return ReturnApi::Success('Jogador deletado com sucesso', $games);
    }
}