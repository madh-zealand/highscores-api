<?php

namespace App\Policies;

use App\Models\Highscore;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class HighscorePolicy
{
    use HandlesAuthorization;

    private function userOwnsGame(User $user, Highscore $highscore): Response
    {
        return $user->id === $highscore->game->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Highscore $highscore): Response
    {
        return $this->userOwnsGame($user, $highscore);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Highscore $highscore): Response
    {
        return $this->userOwnsGame($user, $highscore);
    }

    public function delete(User $user, Highscore $highscore): Response
    {
        return $this->userOwnsGame($user, $highscore);
    }

    public function restore(User $user, Highscore $highscore): Response
    {
        return $this->userOwnsGame($user, $highscore);
    }

    public function forceDelete(User $user, Highscore $highscore): Response
    {
        return $this->userOwnsGame($user, $highscore);
    }
}
