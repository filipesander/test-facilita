<?php

namespace App\Http\Requests\LibraryUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLibraryUserRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:library_users,email,' . $this->route('users_library')->id,
            'registration_number' => 'required|string|unique:library_users,registration_number,' . $this->route('users_library')->id,
        ];
    }
}
