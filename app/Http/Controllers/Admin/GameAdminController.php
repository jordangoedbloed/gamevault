<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $games = Game::query()
            ->when($q, fn($qb)=>$qb->where('title','like',"%{$q}%"))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.games.index', compact('games', 'q'));
    }

    // POST /admin/games/{game}/toggle-active
    public function toggleActive(Game $game)
    {
        $game->update(['is_active' => ! $game->is_active]);
        return back()->with('status', "‘{$game->title}’ is_active → ".($game->is_active ? 'JA' : 'NEE'));
    }

    // POST /admin/games/{game}/toggle-featured
    public function toggleFeatured(Game $game)
    {
        $game->update(['is_featured' => ! $game->is_featured]);
        return back()->with('status', "‘{$game->title}’ featured → ".($game->is_featured ? 'JA' : 'NEE'));
    }
}
