<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('genre')->orderBy('name')->get();
        $genres = Genre::all();
        return Inertia::render('Books/Index', [
            'books' => $books,
            'genres' => $genres
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'register_number' => 'required|string|unique:books',
            'status' => 'required|string',
            'genre_id' => 'required|exists:genres,id'
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Livro adicionado com sucesso!');
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'register_number' => 'required|string|unique:books,register_number,' . $book->id,
            'status' => 'required|string',
            'genre_id' => 'required|exists:genres,id'
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }
}
