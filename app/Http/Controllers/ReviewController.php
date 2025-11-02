<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
use App\Models\PlaySession;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Game $game)
    {
        // Validatie input
        $data = $request->validate([
            'rating' => ['required','integer','between:1,5'],
            'body'   => ['required','string','min:10','max:2000'],
        ]);

        //  Diepere validatie: minimaal 5 verschillende speeldagen
        $distinctDays = PlaySession::where('user_id', auth()->id())
            ->where('game_id', $game->id)
            ->distinct('played_on')
            ->count('played_on');

        if ($distinctDays < 5) {
            return back()
                ->withErrors(['body' => 'Je kunt pas een review plaatsen na minimaal 5 verschillende speeldagen. (Nu: '.$distinctDays.'/5)'])
                ->withInput();
        }

        //  Uniek per user+game — maak of update
        Review::updateOrCreate(
            ['user_id' => auth()->id(), 'game_id' => $game->id],
            ['rating' => $data['rating'], 'body' => $data['body']]
        );

        return back()->with('status', 'Review geplaatst! Bedankt 🙌');
    }
}
