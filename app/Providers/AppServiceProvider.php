<?php

namespace App\Providers;

use App\Models\Game;
use App\Models\Highscore;
use App\Policies\GamePolicy;
use App\Policies\HighscorePolicy;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Game::class, GamePolicy::class);
        Gate::policy(Highscore::class, HighscorePolicy::class);

        Route::bind('games', function (string $value): EloquentCollection {
            // Parse IDs
            $ids = collect(explode(',', $value))
                ->filter(fn($id) => is_numeric($id) && $id > 0)
                ->map(fn($id) => (int) $id)
                ->unique();

            // Fetch models
            $games = Game::whereIn('id', $ids)->get();

            // Validate: fail if any IDs were not found
            if ($games->count() !== $ids->count()) {
                abort(404, 'One or more games not found');
            }

            return $games;
        });
    }
}
