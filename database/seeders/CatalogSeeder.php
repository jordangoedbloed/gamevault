<?php

namespace Database\Seeders;

use App\Models\{Genre, Platform, Game};
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Action','RPG','Adventure','Indie','Strategy'] as $g) {
            Genre::firstOrCreate(['name'=>$g]);
        }

        foreach (['PC','PlayStation 5','Xbox Series','Nintendo Switch'] as $p) {
            Platform::firstOrCreate(['name'=>$p]);
        }

        // Een paar demo games
        $games = [
            ['title'=>'Hyrule Quest', 'description'=>'Open-world adventure'],
            ['title'=>'Star Ranger',  'description'=>'Space action shooter'],
            ['title'=>'Indie Valley', 'description'=>'Cozy farming sim'],
        ];
        foreach ($games as $g) {
            $game = Game::firstOrCreate(['title'=>$g['title']], ['description'=>$g['description']]);
            // Koppel 1 genre + 2 platforms ter demo
            $genreId = Genre::inRandomOrder()->value('id');
            $platformIds = Platform::inRandomOrder()->limit(2)->pluck('id');
            $game->genres()->sync([$genreId]);
            $game->platforms()->sync($platformIds);
        }
    }
}
