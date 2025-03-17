<?php

namespace Database\Seeders;

use App\Models\LibraryUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibraryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LibraryUser::create([
            'name' => 'Filipe Sander',
            'email' => 'filipesander@facilita.com',
            'registration_number' => '123456789'
        ]);

        LibraryUser::create([
            'name' => 'Stephanie Almeida',
            'email' => 'stephanie.almeida@gmail.com',
            'registration_number' => '987654321'
        ]);

        LibraryUser::create([
            'name' => 'Carlos Ferreira',
            'email' => 'carlos.ferreira@gmail.com',
            'registration_number' => '654321987'
        ]);

        LibraryUser::create([
            'name' => 'Filipe Deschamps',
            'email' => 'filipedeschamps@dev.com',
            'registration_number' => '321789654'
        ]);
    }
}
