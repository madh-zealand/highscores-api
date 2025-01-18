<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        $token = $user->createToken('Test Game');

        $this->command->info("API Token: {$token->plainTextToken}");

        Game::factory()->create([
            'user_id' => $user->id,
        ]);
        Game::factory()->create([
            'user_id' => $user->id,
        ]);
    }
}
