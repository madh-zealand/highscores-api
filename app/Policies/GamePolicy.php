<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GamePolicy
{
    use HandlesAuthorization;

    private function userOwnsGame(User $user, Game $game): Response
    {
        return $user->id === $game->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Game $game): Response
    {
        return $this->userOwnsGame($user, $game);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Game $game): Response
    {
        return $this->userOwnsGame($user, $game);
    }

    public function delete(User $user, Game $game): Response
    {
        return $this->userOwnsGame($user, $game);
    }

    public function restore(User $user, Game $game): Response
    {
        return $this->userOwnsGame($user, $game);
    }

    public function forceDelete(User $user, Game $game): Response
    {
        return $this->userOwnsGame($user, $game);
    }
}
