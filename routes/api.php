<?php

use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\HighscoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::controller(GameController::class)
        ->group(function () {
            Route::get('/games', 'index');
            Route::post('/games', 'store');
            Route::get('/games/{game}', 'show');
            Route::put('/games/{game}', 'update');
            Route::delete('/games/{game}', 'destroy');
        });

    Route::controller(HighscoreController::class)
        ->prefix('/games/{game}')
        ->scopeBindings()
        ->group(function () {
            Route::get('/highscores', 'index');
            Route::post('/highscores', 'store');
            Route::get('/highscores/{highscore}', 'show');
            Route::put('/highscores/{highscore}', 'update');
            Route::delete('/highscores/{highscore}', 'destroy');
        });

});
