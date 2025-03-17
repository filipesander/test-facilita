<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create(['name' => 'Romance']);
        Genre::create(['name' => 'Ficção Científica']);
        Genre::create(['name' => 'Poesia']);
        Genre::create(['name' => 'Dramático']);

    }
}
