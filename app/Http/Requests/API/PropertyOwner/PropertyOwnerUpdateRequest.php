<?php

namespace App\Http\Requests\API\PropertyOwner;

use Illuminate\Foundation\Http\FormRequest;

class PropertyOwnerUpdateRequest extends FormRequest
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
            'name ' => 'string|nullable|',
            'email' => 'string|nullable|unique:property_owners,email',
            'phone' => 'string|nullable',
            'address' => 'string|nullable',
            'state_id' => 'integer|nullable|exists:states,id',
            'zip' => 'string|nullable',
            "dba" => "string|nullable",
        ];
    }
}
