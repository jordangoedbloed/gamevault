<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Action RPG',
            'Roguelike',
            'Cozy / Simulation',
            'Open World',
            'Indie',
        ] as $name) {
            Genre::firstOrCreate(['name' => $name]);
        }
    }
}