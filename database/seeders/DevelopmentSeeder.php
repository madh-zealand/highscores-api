<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Highscore;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = $this->createUserWithGames(
            name: 'John Doe',
            email: 'john@example.com',
            password: 'password',
            games: 2,
        );

        $user2 = $this->createUserWithGames(
            name: 'Jane Doe',
            email: 'jane@example.com',
            password: 'password',
            games: 1,
        );

        $user3 = $this->createUserWithGames(
            name: 'Jessica Doe',
            email: 'jessica@example.com',
            password: 'password',
            games: 2,
        );

        $user4 = $this->createUserWithGames(
            name: 'Jolly Doe',
            email: 'jolly@example.com',
            password: 'password',
            games: 3,
        );
    }

    private function createUserWithGames(string $name, string $email, string $password, int $games): User
    {
        $user = $this->createUser(
            name: $name,
            email: $email,
            password: $password,
        );
        foreach (range(1, $games) as $index) {
            $game = $this->createGame(
                user: $user,
            );
        }

        return $user;
    }

    private function createUser(string $name, string $email, string $password): User
    {
        /** @var User $user */
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $token = $user->createToken('Test Game');

        $this->command->info("name: {$name}");
        $this->command->info("email: {$email}");
        $this->command->info("password: {$password}");
        $this->command->info("API Token: {$token->plainTextToken}");

        return $user;
    }

    private function createGame(User $user, ?string $title = null): Game
    {
        $game = Game::factory()->create(
            array_merge(
                [
                    'user_id' => $user->id,
                ],
                is_null($title) ? [] : [
                    'title' => $title,
                ]
            ),
        );

        $game->highscores()->saveMany(
            Highscore::factory(random_int(10, 100))->make(['game_id' => $game->id]),
        );

        return $game;
    }
}
