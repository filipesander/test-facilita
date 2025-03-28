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
    Route::resource('users-library', App\Http\Controllers\LibraryUserController::class);
    Route::resource('books', App\Http\Controllers\BookController::class);
    Route::resource('loans', App\Http\Controllers\LoanController::class);
    Route::put('/loans/{loan}/status', [App\Http\Controllers\LoanController::class, 'updateStatus'])->name('loans.updateStatus');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
