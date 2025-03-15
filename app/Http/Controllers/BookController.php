<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Retonar todos os livros cadastrados
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $books = Book::with('genre')->orderBy('name')->get();
        $genres = Genre::all();
        return Inertia::render('Books/Index', [
            'books' => $books,
            'genres' => $genres
        ]);
    }

    /**
     * Cria um livro
     * @param StoreBookRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();

            Book::create($validatedData);

            return redirect()->route('books.index')->with('success', 'Livro adicionado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao adicionar livro: ' . $e->getMessage());

            return back()->withErrors('Erro ao adicionar o livro. Tente novamente.');
        }
    }

    /**
     * Atualiza um livro
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        try {
            $validatedData = $request->validated();

            $book->update($validatedData);

            return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar livro: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar o livro. Tente novamente.');
        }
    }

    /**
     * Exclui um livro
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }
}
