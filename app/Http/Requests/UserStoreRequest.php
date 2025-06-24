<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,superadmin',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Name is required.',
            'name.max'          => 'Name may not be greater than 255 characters.',
            'email.required'    => 'Email is required.',
            'email.email'       => 'Email format is invalid.',
            'email.unique'      => 'Email has already been taken.',
            'password.required' => 'Password is required.',
            'password.min'      => 'Password must be at least 6 characters.',
            'role.required'     => 'Role is required.',
            'role.in'           => 'Role must be admin or superadmin.',
        ];
    }
}
