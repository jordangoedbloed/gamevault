<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\PlaySession;

class PlaySessionController extends Controller
{
    public function store(Game $game)
    {
        // 1 per dag per user per game
        PlaySession::firstOrCreate([
            'user_id'   => auth()->id(),
            'game_id'   => $game->id,
            'played_on' => now()->toDateString(),
        ]);

        return back()->with('status', 'Speelsessie voor vandaag geregistreerd!');
    }
}
