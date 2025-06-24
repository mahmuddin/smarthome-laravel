<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'sometimes|required|string|max:255',
            'email'    => 'sometimes|required|email|unique:users,email,' . $this->route('id'),
            'password' => 'nullable|string|min:6',
            'role'     => 'sometimes|required|in:admin,superadmin',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Name is required.',
            'name.max'       => 'Name may not be greater than 255 characters.',
            'email.required' => 'Email is required.',
            'email.email'    => 'Email format is invalid.',
            'email.unique'   => 'Email has already been taken.',
            'password.min'   => 'Password must be at least 6 characters.',
            'role.required'  => 'Role is required.',
            'role.in'        => 'Role must be admin or superadmin.',
        ];
    }
}
