<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Highscore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class HighscoreFactory extends Factory
{
    protected $model = Highscore::class;

    public function definition(): array
    {
        return [
            'game_id' => Game::factory(),
            'player' => $this->faker->firstName(),
            'score' => $this->faker->numberBetween(0, 100_000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
