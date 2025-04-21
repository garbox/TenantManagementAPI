<?php

namespace App\Http\Requests\API\Property;

use Illuminate\Foundation\Http\FormRequest;

class PropertyUpdateRequest extends FormRequest
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
            'property_owner_id' => 'integer|nullable|exists:property_owners,id',
            'address' => 'string|nullable',
            'state_id' => 'integer|nullable|exists:states,id',
            'city' => 'string|nullable',
            'zip' => 'integer|nullable',
        ];
    }
}
