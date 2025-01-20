<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
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
Route::get('/games/{game}/embed', [GameController::class, 'embeddedHighscore'])->name('games.embed.simple');
