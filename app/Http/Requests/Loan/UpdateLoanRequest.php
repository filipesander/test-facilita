<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'due_date' => 'required|date|after:today',
            'status' => 'required|in:emprestado,atrasado,devolvido',
        ];
    }
}
