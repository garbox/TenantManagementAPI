<?php

namespace App\Http\Requests\API\Maintenance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Schema;

class MaintenanceSearch extends FormRequest
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
    public function rules(): array{
        return [
            'field' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!Schema::hasColumn('maintenances', $value)) {
                        $fail("The selected $attribute is not a valid column.");
                    }
                },
            ],
            'value' => 'nullable|string',
        ];
    }
}
