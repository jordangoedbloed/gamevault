<?php

namespace App\Http\Controllers;

use App\Models\{Game, Genre, Platform};
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $q  = $request->q;
        $g  = $request->genre;
        $pl = $request->platform;

        $games = Game::with(['genres','platforms'])
            ->active()
            ->search($q)
            ->genre($g)
            ->platform($pl)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('games.index', [
            'games'     => $games,
            'genres'    => Genre::orderBy('name')->get(),
            'platforms' => Platform::orderBy('name')->get(),
            'q' => $q, 'g' => $g, 'pl' => $pl,
        ]);
    }

    public function show(Game $game)
    {
        abort_if(!$game->is_active, 403);
        $game->load(['genres','platforms']);
        return view('games.show', compact('game'));
    }
}
