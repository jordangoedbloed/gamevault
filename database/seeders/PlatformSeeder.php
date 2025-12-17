<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'PC',
            'PlayStation 5',
            'Xbox Series X|S',
            'Nintendo Switch',
        ] as $name) {
            Platform::firstOrCreate(['name' => $name]);
        }
    }
}