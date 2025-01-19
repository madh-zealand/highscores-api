<?php

namespace App\Providers;

use App\Models\Game;
use App\Models\Highscore;
use App\Policies\GamePolicy;
use App\Policies\HighscorePolicy;
use Illuminate\Support\Facades\Gate;
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
    }
}
