<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutomationUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|required|string',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Name is required.',
            'name.string'        => 'Name must be a string.',
            'description.string' => 'Description must be a string.',
            'is_active.boolean'  => 'Active status must be a boolean.',
        ];
    }
}
