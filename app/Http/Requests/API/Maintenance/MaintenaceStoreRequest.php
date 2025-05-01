<?php

namespace App\Http\Requests\API\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class MaintenaceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'maintenance_status_id' => $this->input('maintenance_status_id', 1), // fallback to ID 1
        ]);
    }

    public function rules(): array
    {
        return [
            'maintenance_type_id' => 'integer|required|exists:maintenance_types,id',
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'description' => 'string|required',
        ];
    }
}
