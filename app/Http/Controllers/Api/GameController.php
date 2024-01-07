<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return response()->json($games);
    }

    public function store(Request $request)
    {
        $data = $request->validate(Game::rules());

        $games = Game::create($data);

        return response()->json(['message' => 'Partida criada com sucesso', 'data' => $games], 201);
    }

    public function update(Request $request, $id)
    {
        $games = Game::findOrFail($id);

        $data = $request->validate(Game::rules());

        $games->update($data);

        return response()->json(['message' => 'Partida atualizada com sucesso', 'data' => $games], 200);
    }

    public function destroy($id)
    {
        $games = Game::findOrFail($id);
        $games->delete();

        return response()->json(['message' => 'Partida deletada com sucesso'], 200);
    }
}