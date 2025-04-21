<?php

namespace App\Http\Requests\API\PropertyOwner;

use Illuminate\Foundation\Http\FormRequest;

class PropertyOwnerStoreRequest extends FormRequest
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
            'name' => 'string|required|',
            'email' => 'string|required|unique:property_owners,email',
            'phone' => 'string|required',
            'address' => 'string|required',
            'state_id' => 'integer|required|exists:states,id',
            'zip' => 'integer|required',
            "dba" => "string|nullable",
        ];
    }
}
