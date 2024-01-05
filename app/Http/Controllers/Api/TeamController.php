<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

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

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(null, 204);
    }
}
