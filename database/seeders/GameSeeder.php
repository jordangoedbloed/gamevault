<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            [
                'title' => 'Elden Ring',
                'description' => 'Dark fantasy action RPG with a vast open world.',
                'featured' => true,
                'genres' => ['Action RPG', 'Open World'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            ],
            [
                'title' => 'Hades',
                'description' => 'Fast-paced roguelike dungeon crawler.',
                'featured' => false,
                'genres' => ['Roguelike', 'Indie'],
                'platforms' => ['PC', 'Nintendo Switch', 'PlayStation 5'],
            ],
            [
                'title' => 'Stardew Valley',
                'description' => 'Relaxing farming and life simulation game.',
                'featured' => false,
                'genres' => ['Cozy / Simulation', 'Indie'],
                'platforms' => ['PC', 'Nintendo Switch'],
            ],
            [
                'title' => 'Cyberpunk 2077',
                'description' => 'Futuristic open-world RPG set in Night City.',
                'featured' => true,
                'genres' => ['Action RPG', 'Open World'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            ],
            [
                'title' => 'The Witcher 3',
                'description' => 'Story-driven open-world RPG.',
                'featured' => true,
                'genres' => ['Action RPG', 'Open World'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X|S', 'Nintendo Switch'],
            ],
            [
                'title' => 'Hollow Knight',
                'description' => 'Atmospheric metroidvania adventure.',
                'featured' => false,
                'genres' => ['Indie', 'Action RPG'],
                'platforms' => ['PC', 'Nintendo Switch', 'PlayStation 5'],
            ],
            [
                'title' => 'DOOM Eternal',
                'description' => 'High-speed first-person shooter.',
                'featured' => false,
                'genres' => ['Shooter'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            ],
            [
                'title' => 'Red Dead Redemption 2',
                'description' => 'Epic western open-world adventure.',
                'featured' => true,
                'genres' => ['Open World'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            ],
            [
                'title' => 'Factorio',
                'description' => 'Build and optimize massive automated factories.',
                'featured' => false,
                'genres' => ['Strategy'],
                'platforms' => ['PC'],
            ],
            [
                'title' => 'Valheim',
                'description' => 'Survival and exploration in a Viking-themed world.',
                'featured' => false,
                'genres' => ['Survival', 'Indie'],
                'platforms' => ['PC'],
            ],
            [
                'title' => 'Subnautica',
                'description' => 'Underwater survival exploration game.',
                'featured' => false,
                'genres' => ['Survival'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            ],
            [
                'title' => 'Dead Cells',
                'description' => 'Roguelike metroidvania with fast combat.',
                'featured' => false,
                'genres' => ['Roguelike', 'Indie'],
                'platforms' => ['PC', 'Nintendo Switch'],
            ],
            [
                'title' => 'Minecraft',
                'description' => 'Creative sandbox survival game.',
                'featured' => true,
                'genres' => ['Survival'],
                'platforms' => ['PC', 'Nintendo Switch', 'PlayStation 5', 'Xbox Series X|S'],
            ],
            [
                'title' => 'Celeste',
                'description' => 'Challenging platformer with emotional story.',
                'featured' => false,
                'genres' => ['Indie'],
                'platforms' => ['PC', 'Nintendo Switch'],
            ],
            [
                'title' => 'No Man’s Sky',
                'description' => 'Procedurally generated space exploration.',
                'featured' => false,
                'genres' => ['Survival', 'Open World'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            ],
            [
                'title' => 'Baldur’s Gate 3',
                'description' => 'Deep narrative-driven RPG based on D&D.',
                'featured' => true,
                'genres' => ['Action RPG'],
                'platforms' => ['PC', 'PlayStation 5'],
            ],
            [
                'title' => 'Among Us',
                'description' => 'Social deduction multiplayer game.',
                'featured' => false,
                'genres' => ['Indie'],
                'platforms' => ['PC', 'Nintendo Switch'],
            ],
            [
                'title' => 'Cities: Skylines',
                'description' => 'City-building and management simulation.',
                'featured' => false,
                'genres' => ['Strategy', 'Simulation'],
                'platforms' => ['PC', 'PlayStation 5'],
            ],
            [
                'title' => 'Dark Souls III',
                'description' => 'Challenging dark fantasy action RPG.',
                'featured' => false,
                'genres' => ['Action RPG'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            ],
            [
                'title' => 'Slay the Spire',
                'description' => 'Deck-building roguelike strategy game.',
                'featured' => false,
                'genres' => ['Roguelike', 'Strategy'],
                'platforms' => ['PC', 'Nintendo Switch'],
            ],
        ];

        foreach ($games as $g) {
            $game = Game::updateOrCreate(
                ['title' => $g['title']],
                [
                    'description' => $g['description'],
                    'is_active' => true,
                    'is_featured' => $g['featured'],
                ]
            );

            $genreIds = Genre::whereIn('name', $g['genres'])->pluck('id')->all();
            $platformIds = Platform::whereIn('name', $g['platforms'])->pluck('id')->all();

            $game->genres()->sync($genreIds);
            $game->platforms()->sync($platformIds);
        }
    }
}