<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::all();
        return response()->json($players);
    }

    public function show($id)
    {
        $player = Player::findOrFail($id);
        return response()->json($player);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'shirt_number' => 'required|integer',
        ]);

        $player = Player::create($data);

        return response()->json($player, 201);
    }

    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);

        $data = $request->validate([
            'name' => 'string',
            'shirt_number' => 'integer',
        ]);

        $player->update($data);

        return response()->json($player, 200);
    }

    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return response()->json(null, 204);
    }
}