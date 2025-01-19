<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GameController extends Controller
{
    public function index(Request $request): Responsable|JsonResponse
    {
        // Make sure we have permission to view all
        Gate::authorize('viewAny', Game::class);

        // Get all the users games
        $games = $request->user()->games;

        // Return them as a resource collection
        return GameResource::collection($games);
    }

    public function store(Request $request): Responsable|JsonResponse
    {
        // Make sure we have permission to create
        Gate::authorize('create', Game::class);

        // Validate the input required to create a new game
        $data = $request->validate([
            'title' => ['required'],
        ]);

        // Create the new game for the user
        $game = $request->user()
            ->games()
            ->create($data);

        // Return the new game as a resource
        return new GameResource($game);
    }

    public function show(Game $game): Responsable|JsonResponse
    {
        // Make sure we have permission to view
        Gate::authorize('view', $game);

        // Return the game as a resource
        return new GameResource($game);
    }

    public function update(Request $request, Game $game): Responsable|JsonResponse
    {
        // Make sure we have permission to update
        Gate::authorize('update', $game);

        // Validate the input required to update a game
        $data = $request->validate([
            'title' => ['required'],
        ]);

        // Update the game with the new input
        $game->update($data);

        // Return the updated game as a resource
        return new GameResource($game);
    }

    public function destroy(Game $game): Responsable|JsonResponse
    {
        // Make sure we have permission to delete
        Gate::authorize('delete', $game);

        // Delete the users game
        $game->delete();

        // Return an empty response
        return response()->json();
    }
}
