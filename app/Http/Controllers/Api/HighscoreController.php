<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HighscoreResource;
use App\Models\Game;
use App\Models\Highscore;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HighscoreController extends Controller
{
    public function index(Game $game): Responsable|JsonResponse
    {

        // Make sure we have permission to view all
        Gate::authorize('view', $game);
        Gate::authorize('viewAny', Highscore::class);

        // Get all the highscores for the game
        $highscores = $game->highscores()
            ->orderByDesc('score')
            ->get();

        return HighscoreResource::collection($highscores);
    }

    public function store(Request $request, Game $game): Responsable|JsonResponse
    {
        // Make sure we have permission to create
        Gate::authorize('create', Highscore::class);

        // Validate the input required to create a new highscore
        $data = $request->validate([
            'player' => ['required'],
            'score' => ['required', 'numeric', 'min:0'],
        ]);

        // Create the new highscore for the game
        $highscore = $game
            ->highscores()
            ->create($data);

        // Return the new highscore as a resource
        return new HighscoreResource($highscore);
    }

    public function show(Game $game, Highscore $highscore): Responsable|JsonResponse
    {
        // Make sure we have permission to highscore
        Gate::authorize('view', $highscore);

        // Return the highscore as a resource
        return new HighscoreResource($highscore);
    }

    public function update(Request $request, Game $game, Highscore $highscore): Responsable|JsonResponse
    {
        // Make sure we have permission to update
        Gate::authorize('update', $highscore);

        // Validate the input required to update a highscore
        $data = $request->validate([
            'player' => ['sometimes'],
            'score' => ['sometimes', 'numeric', 'min:0'],
        ]);

        // Update the highscore with the new input
        $highscore->update($data);

        // Return the updated highscore as a resource
        return new HighscoreResource($highscore);
    }

    public function destroy(Game $game, Highscore $highscore): Responsable|JsonResponse
    {
        // Make sure we have permission to delete
        Gate::authorize('delete', $highscore);

        // Delete the users game
        $highscore->delete();

        // Return an empty response
        return response()->json();
    }
}
