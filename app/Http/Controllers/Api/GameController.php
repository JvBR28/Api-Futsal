<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return response()->json($games);
    }

    public function store(GameRequest $request)
    {
        $data = $request->validated();
    
        $game = Game::create($data);
    
        return response()->json(['message' => 'Partida criada com sucesso', 'data' => $game], 201);
    }

    public function update(GameRequest $request, $id)
    {
        $game = Game::findOrFail($id);
    
        $data = $request->validated();
    
        $game->update($data);
    
        return response()->json(['message' => 'Partida atualizada com sucesso', 'data' => $game], 200);
    }

    public function destroy($id)
    {
        $games = Game::findOrFail($id);
        $games->delete();

        return response()->json(['message' => 'Partida deletada com sucesso'], 200);
    }
}