<?php

namespace App\Http\Requests\API\Property;

use Illuminate\Foundation\Http\FormRequest;

class PropertyStoreRequest extends FormRequest
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
            'property_owner_id' => 'integer|required|existes:property_owners,id',
            'address' => 'string|required',
            'state_id' => 'string|required|existes:states,id',
            'city' => 'string|required',
            'zip' => 'integer|required',
        ];
    }
}
