<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'register_number' => 'required|string|unique:books,register_number,' . $this->route('book')->id,
            'status' => 'required|string|in:disponível,emprestado',
            'genre_id' => 'required|exists:genres,id'
        ];
    }
}
