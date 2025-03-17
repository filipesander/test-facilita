<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryUser\StoreLibraryUserRequest;
use App\Http\Requests\LibraryUser\UpdateLibraryUserRequest;
use App\Models\LibraryUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;

class LibraryUserController extends Controller
{
    /**
     * Lista os usuários
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $users = LibraryUser::orderBy('name')->get();
        return Inertia::render('LibraryUsers/Index', [
            'users' => $users
        ]);
    }

    /**
     * Cria um usuário
     * @param StoreLibraryUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreLibraryUserRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();

            LibraryUser::create($validatedData);

            return redirect()->route('users-library.index')->with('success', 'Usuário cadastrado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar usuário: ' . $e->getMessage());
            return back()->withErrors('Erro ao cadastrar usuário. Tente novamente.');
        }
    }

    /**
     * Atualiza um usuário
     * @param Request $request
     * @param LibraryUser $users_library
     * @return RedirectResponse
     */
    public function update(UpdateLibraryUserRequest $request, LibraryUser $users_library): RedirectResponse
    {
        try {
            $validatedData = $request->validated();

            $users_library->update($validatedData);

            return redirect()->route('users-library.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar usuário: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar usuário. Tente novamente.');
        }
    }

    /**
     * Remove um usuário
     * @param LibraryUser $users_library
     * @return RedirectResponse
     */
    public function destroy(LibraryUser $users_library): RedirectResponse
    {
        try {
            $users_library->delete();
            return redirect()->route('users-library.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir usuário: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir usuário. Tente novamente.');
        }
    }
}
