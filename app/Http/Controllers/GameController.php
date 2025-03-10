<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Highscore;
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
        $fontSize = $request->query('fontSize', 100);

        return response()
            ->view('presentation.presentation', [
                'game' => $game,
                'highscores' => $game->highscores()
                    ->orderByDesc('score')
                    ->limit(20)
                    ->get()
                    ->pad(20, new Highscore(['player' => '-', 'score' => '-'])),
                'fontSize' => $fontSize,
            ]);
    }
}
