<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Atur sesuai kebijakan autentikasi
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|string|min:3',
            'domain' => 'nullable|string', // pastikan ada jika digunakan
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
