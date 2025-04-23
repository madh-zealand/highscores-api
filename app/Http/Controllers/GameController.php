<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Highscore;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(Request $request): View
    {
        return view('games/index', [
            'user' => $request->user(),
            'games' => $request->user()
                ->games()
                ->get(),
        ]);
    }

    public function show(Request $request, Game $game): View
    {
        return view('games.show', [
            'game' => $game,
            'highscores' => $game->highscores()
                ->orderByDesc('score')
                ->get(),
        ]);
    }

    public function embeddedHighscore(Request $request, Game $game): Response
    {
        $fontSize = $request->query('fontSize', 100);
        $bgColor = $request->query('bgColor', '#ffffff');
        $textColor = $request->query('textColor', '#111827');
        $borderColor = $request->query('borderColor', '#e5e7eb');

        return response()
            ->view('embedded.highscore.simple', [
                'game' => $game,
                'highscores' => $game->highscores()
                    ->orderByDesc('score')
                    ->limit(10)
                    ->get()
                    ->pad(10, new Highscore(['player' => '-', 'score' => '-'])),
                'fontSize' => $fontSize,
                'bgColor' => $bgColor,
                'textColor' => $textColor,
                'borderColor' => $borderColor,
            ]);
    }

    public function presentHighscore(Request $request, Game $game): Response
    {
        $fontSize = (int) $request->query('fontSize', 100);
        $shouldHideControls = (bool) $request->query('hideControls', 0);
        $refreshRate = (int) $request->query('refreshRate', 5000);

        return response()
            ->view('presentation.presentation', [
                'game' => $game,
                'highscores' => $game->highscores()
                    ->orderByDesc('score')
                    ->limit(10)
                    ->get()
                    ->pad(10, new Highscore(['player' => '-', 'score' => '-'])),
                'fontSize' => $fontSize,
                'shouldHideControls' => $shouldHideControls,
                'refreshRate' => $refreshRate,
            ]);
    }

    /**
     * @param EloquentCollection<Game> $games
     */
    public function presentManyHighscores(Request $request, EloquentCollection $games): Response
    {
        $fontSize = $request->query('fontSize', 100);

//        $games->load('highscores');

        return response()
            ->view('presentation.presentation-many', [
                'games' => $games,
                'fontSize' => $fontSize,
            ]);
    }
}
