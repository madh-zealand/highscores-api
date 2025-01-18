<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(): Responsable|JsonResponse
    {
        return GameResource::collection(Game::all());
    }

    public function store(Request $request): Responsable|JsonResponse
    {
        $data = $request->validate([
            'title' => ['required'],
        ]);

        $game = $request->user()->games()->create($data);

        return new GameResource($game);
    }

    public function show(Game $game): Responsable|JsonResponse
    {
        return new GameResource($game);
    }

    public function update(Request $request, Game $game): Responsable|JsonResponse
    {
        $data = $request->validate([
            'title' => ['required'],
        ]);

        $game->update($data);

        return new GameResource($game);
    }

    public function destroy(Game $game): Responsable|JsonResponse
    {
        $game->delete();

        return response()->json();
    }
}
