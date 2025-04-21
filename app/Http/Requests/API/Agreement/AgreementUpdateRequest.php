<?php

namespace App\Http\Requests\API\Agreement;

use Illuminate\Foundation\Http\FormRequest;

class AgreementUpdateRequest extends FormRequest
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
            'user_id' => 'integer|nullable|existes:users,id',
            'property_id' => 'string|nullable|existes:properties.id',
            'file_name' => 'nullable|file|mimes:pdf|max:5000',
            'security_deposit' => 'integer|nullable',
            'rent' => 'integer|nullable',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
        ];
    }
}
