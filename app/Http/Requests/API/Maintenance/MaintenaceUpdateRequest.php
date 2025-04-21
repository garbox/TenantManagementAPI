<?php

namespace App\Http\Requests\API\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class MaintenaceUpdateRequest extends FormRequest
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
            'maintenance_type_id' => 'integer|nullable|exists:maintenance_types,id',
            'user_id' => 'string|nullable|exists:users,id',
            'property_id' => 'string|nullable',
            'description' => 'string|nullable',
            'assigned_to' => 'integer|nullable|exists:users,id'
        ];
    }
}
