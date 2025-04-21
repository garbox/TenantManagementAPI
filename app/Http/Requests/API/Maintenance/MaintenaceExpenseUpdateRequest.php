<?php

namespace App\Http\Requests\API\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class MaintenaceExpenseUpdateRequest extends FormRequest
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
            'maintenance_id' => 'string|nullable|existes:mainteance.id',
            'note' => 'string|nullable',
        ];
    }
}
