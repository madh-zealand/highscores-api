<?php

namespace App\Http\Resources;

use App\Models\Highscore;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Highscore */
class HighscoreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'game_id' => $this->game_id,
            'player' => $this->player,
            'score' => $this->score,
            'created_at' => $this->created_at,
        ];
    }
}
