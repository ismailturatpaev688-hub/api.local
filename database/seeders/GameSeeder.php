<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
            'title' => 'GTA 6',
            'genre' => 'CAIF',
            'gamepad' => true
        ]);
        Game::create([
            'title' => 'Cyberpunk 2077',
            'genre' => 'RPG',
            'gamepad' => true
        ]);
        Game::create([
            'title' => 'DOOM',
            'genre' => 'SHOOTER',
            'gamepad' => false
        ]);
        Game::create([
            'title' => 'Герои меча и магии',
            'genre' => 'RPG/MMO',
            'gamepad' => false
        ]);
        Game::create([
            'title' => 'Deadlock',
            'genre' => 'MOBA/PVP',
            'gamepad' => false
        ]);
        Game::create([
            'title' => 'Rust',
            'genre' => 'PVP',
            'gamepad' => true
        ]);
        Game::create([
            'title' => 'GTA 5',
            'genre' => 'Story',
            'gamepad' => true
        ]);
        Game::create([
            'title' => 'Disco Elisium',
            'genre' => 'RPG',
            'gamepad' => false
        ]);
        Game::create([
            'title' => 'Mafia',
            'genre' => 'Story',
            'gamepad' => true
        ]);
    }
}
