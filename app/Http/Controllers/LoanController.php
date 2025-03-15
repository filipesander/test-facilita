<?php

namespace App\Http\Controllers;

use App\Http\Requests\Loan\StoreLoanRequest;
use App\Http\Requests\Loan\UpdateLoanRequest;
use App\Models\Loan;
use App\Models\LibraryUser;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class LoanController extends Controller
{
    public function index(): \Inertia\Response
    {
        $loans = Loan::with(['libraryUser', 'book'])->orderBy('due_date')->get();
        $users = LibraryUser::orderBy('name')->get();
        $books = Book::orderBy('name')->get();

        return Inertia::render('Loans/Index', [
            'loans' => $loans,
            'users' => $users,
            'books' => $books,
        ]);
    }

    public function store(StoreLoanRequest $request): RedirectResponse
    {
        try {
            Loan::create($request->validated());
            return redirect()->route('loans.index')->with('success', 'Empréstimo registrado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao registrar empréstimo: ' . $e->getMessage());
            return back()->withErrors('Erro ao registrar empréstimo. Tente novamente.');
        }
    }

    public function update(UpdateLoanRequest $request, Loan $loan): RedirectResponse
    {
        try {
            $loan->update($request->validated());
            return redirect()->route('loans.index')->with('success', 'Empréstimo atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar empréstimo: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar empréstimo. Tente novamente.');
        }
    }


    public function updateStatus(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:emprestado,devolvido,atrasado'
        ]);

        try {
            $loan->update(['status' => $request->status]);
            return redirect()->route('loans.index')->with('success', 'Status atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar status do empréstimo: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar status do empréstimo. Tente novamente.');
        }
    }

    public function destroy(Loan $loan): RedirectResponse
    {
        try {
            $loan->delete();
            return redirect()->route('loans.index')->with('success', 'Empréstimo excluído com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir empréstimo: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir empréstimo. Tente novamente.');
        }
    }
}
