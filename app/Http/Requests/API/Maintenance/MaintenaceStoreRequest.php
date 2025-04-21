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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'maintenance_type_id' => 'integer|required|existes:maintenance_types,id',
            'user_id' => 'string|required|existes:users.id',
            'property_id' => 'string|required|existes:properties.id',
            'description' => 'string|required',
        ];
    }
}
