<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $game_id
 * @property string $player
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Game|null $game
 * @method static \Database\Factories\HighscoreFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Highscore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Highscore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Highscore onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Highscore query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Highscore withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Highscore withoutTrashed()
 * @mixin \Eloquent
 */
class Highscore extends Model
{
    /** @use HasFactory<\Database\Factories\HighscoreFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [
        'id',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
