<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return response()->json($teams);
    }

    public function show($id) 
    {
        $team = Team::findOrFail($id);
        return response()->json($team);
    }

    public function store(Request $request)
    {
        $data = $request->validate(Team::rules());

        $team = Team::create($data);

        return response()->json($team, 201);
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $data = $request->validate(Team::rules($id));

        $team->update($data);

        return response()->json($team, 200);
    }

    public function rankings()
    {
        Log::info('Entrou no método de ranking');

        try {
            $teams = Team::orderByDesc('points')->get();

            $teamsWithGoals = $teams->map(function ($team) {
                return [
                    'id' => $team->id,
                    'name' => $team->name,
                    'points' => $team->points,
                    'total_goals' => $team->getTotalGoals(),
                ];
            });

            return response()->json(['error' => false, 'message' => 'Classificação dos times:', 'data' => $teamsWithGoals], 200);
        } catch (\Exception $e) {
            Log::error('Erro ao obter a classificação dos times: ' . $e->getMessage());
            return response()->json(['error' => true, 'message' => 'Erro ao obter a classificação dos times.', 'data' => null], 500);
        }
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(null, 204);
    }

    public function players(Team $team)
    {
        $players = $team->players;

        return response()->json($players);
    }
}
