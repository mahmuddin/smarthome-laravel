<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutomationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'home_id'     => 'required|exists:homes,id',
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'home_id.required'   => 'Home ID is required.',
            'home_id.exists'     => 'Home ID is not valid.',
            'name.required'      => 'Name is required.',
            'name.string'        => 'Name must be a string.',
            'description.string' => 'Description must be a string.',
            'is_active.boolean'  => 'Active status must be a boolean.',
        ];
    }
}
