<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Rotas da Biblioteca
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('books', App\Http\Controllers\BookController::class);
    Route::resource('genres', App\Http\Controllers\GenreController::class);
    Route::resource('loans', App\Http\Controllers\LoanController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
