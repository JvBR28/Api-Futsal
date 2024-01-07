<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
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

    public function store(TeamRequest $request)
    {
        $data = $request->validated();

        $team = Team::create($data);

        return response()->json(['message' => 'Time criado com sucesso', 'data' => $team], 201);
    }

    public function update(TeamRequest $request, $id)
    {
        $team = Team::findOrFail($id);

        $data = $request->validated();

        $team->update($data);

        return response()->json(['message' => 'Time atualizado com sucesso', 'data' => $team], 200);
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

        return response()->json(['message' => 'Time deletado com sucesso'], 200);
    }

    public function players($id)
    {
        $team = Team::findOrFail($id);
        $players = $team->players;
    
        return response()->json([
            'message' => 'Time com seus jogadores',
            'team' => $team,
        ]);
    }
}
