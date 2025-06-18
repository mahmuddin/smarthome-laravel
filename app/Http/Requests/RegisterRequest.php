<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // pastikan ini true agar bisa diakses
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'role'     => 'nullable|string|in:admin,user',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'The name field is required.',
            'email.required'    => 'The email field is required.',
            'email.email'       => 'The email must be a valid email address.',
            'email.unique'      => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min'      => 'The password must be at least 3 characters.',
            'role.in'           => 'The selected role is invalid. Allowed values: admin or user.',
        ];
    }

}
