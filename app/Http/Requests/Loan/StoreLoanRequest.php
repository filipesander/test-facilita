<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'library_user_id' => 'required|exists:library_users,id',
            'book_id' => 'required|exists:books,id',
            'return_date' => 'required|date|after:today',
            'status' => 'nullable|in:emprestado,atrasado,devolvido',
        ];
    }
}
