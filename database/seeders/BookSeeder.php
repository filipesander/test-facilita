<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::all();

        if ($genres->isEmpty()) {
            $this->command->info('Nenhum gênero encontrado! Execute o GenreSeeder primeiro!');
            return;
        }

        Book::create([
            'name' => '1984',
            'author' => 'George Orwell',
            'register_number' => '001984',
            'status' => 'disponível',
            'genre_id' => $genres->where('name', 'Ficção Científica')->first()->id
        ]);

        Book::create([
            'name' => 'Orgulho e Preconceito',
            'author' => 'Jane Austen',
            'register_number' => '002345',
            'status' => 'emprestado',
            'genre_id' => $genres->where('name', 'Romance')->first()->id
        ]);

        Book::create([
            'name' => 'Dom Quixote',
            'author' => 'Miguel de Cervantes',
            'register_number' => '003210',
            'status' => 'disponível',
            'genre_id' => $genres->where('name', 'Dramático')->first()->id
        ]);

        Book::create([
            'name' => 'Os Lusíadas',
            'author' => 'Luís de Camões',
            'register_number' => '004789',
            'status' => 'disponível',
            'genre_id' => $genres->where('name', 'Poesia')->first()->id
        ]);

    }
}
