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
            'agreement.tenant_id' => 'required|integer|exists:users,id',
            'agreement.property_id' => 'required|string|exists:properties,id',
            'agreement.start_date' => 'required|date',
            'agreement.end_date' => 'required|date',
            'agreement.rent' => 'required|numeric',
            'agreement.application_fee' => 'required|numeric',
            'agreement.late_fee' => 'required|numeric',
            'agreement.grace_period' => 'required|numeric',
            'agreement.security_deposit' => 'required|numeric',
            'pet.pets_allowed' => 'required|in:1,0',
            'pet.requirement' => 'string|nullable',
            'pet.pet_deposit' => 'numeric|nullable',
            'pet.pet_monthly_rate' => 'numeric|nullable',
            'maintenance.tenant_responsibilities' => 'string|nullable',
            'maintenance.land_lord_responsibilities' => 'string|nullable',
            'lead_paint.built_before_1978' => 'required|in:1,0',
            'm2m.month_to_month_rent' => 'required|numeric',
            'm2m.notice' => 'required|numeric',
            'non_renewal.notice_length' => 'required|numeric'   
        ];
    }
}

