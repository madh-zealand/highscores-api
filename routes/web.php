<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Middleware\FrameGuard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/tokens', [ApiTokenController::class, 'create'])->name('profile.tokens.create');
    Route::delete('/profile/tokens/{token}', [ApiTokenController::class, 'destroy'])->name('profile.tokens.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/games', [GameController::class, 'index'])->name('dashboard');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
});

// Embed highscore tables
Route::get('/games/{game}/embed', [GameController::class, 'embeddedHighscore'])
    ->withoutMiddleware([FrameGuard::class])
    ->name('games.embed.simple');

// Public highscore table presenting
Route::get('/presentation/{game}', [GameController::class, 'presentHighscore'])
    ->withoutMiddleware([FrameGuard::class])
    ->name('presentation');

// Public highscore table presenting
Route::get('/presentation/many/{games}', [GameController::class, 'presentManyHighscores'])
    ->where('games', '^[0-9]+(,[0-9]+)*$')
    ->withoutMiddleware([FrameGuard::class])
    ->name('presentation.many');
