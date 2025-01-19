<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('highscores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id');
            $table->string('player');
            $table->unsignedBigInteger('score');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('highscores');
    }
};
