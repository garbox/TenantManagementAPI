<?php

namespace App\Http\Requests\API\Agreement;

use Illuminate\Foundation\Http\FormRequest;

class AgreementStoreRequest extends FormRequest
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
            'user_id' => 'integer|required|existes:users,id',
            'property_id' => 'string|required|existes:properties.id',
            'file_name' => 'required|file|mimes:pdf|max:5000',
            'security_deposit' => 'required|numeric',
            'rent' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}
