<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    public function index()
    {
        return response()->json(Team::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate(Team::rules());

        $team = Team::create($data);

        return ReturnApi::Success('Time criado com sucesso', $team, 201);
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $data = $request->validate(Team::rules($id));

        $team->update($data);

        return ReturnApi::Success('Time atualizado com sucesso', $team);
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

            return ReturnApi::Success('Ranking dos Times:', $teamsWithGoals);
        } catch (\Exception $e) {
            Log::error('Erro ao obter a classificação dos times: ' . $e->getMessage());
            return ReturnApi::Error('Erro ao obter a classificação dos times.', null, $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return ReturnApi::Success('Time deletado com sucesso', $team);
    }

    public function players($id)
    {
        $team = Team::findOrFail($id);
        $team->players;
    
        return ReturnApi::Success('Time com seus jogadores:', ['team' => $team]);

    }
}