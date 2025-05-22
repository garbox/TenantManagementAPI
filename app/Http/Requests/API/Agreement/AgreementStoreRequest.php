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
    public function attributes(): array
    {
        return [
            'agreement.tenant_id' => 'Tenant ',
            'agreement.property_id' => 'Property ',
            'agreement.start_date' => 'Start date',
            'agreement.end_date' => 'End date',
            'agreement.rent' => 'Rent',
            'agreement.application_fee' => 'Application fee',
            'agreement.late_fee' => 'Late fee',
            'agreement.grace_period' => 'Grace period',
            'agreement.security_deposit' => 'Security deposit',
            'pet.pets_allowed' => 'Pets allowed',
            'pet.requirement' => 'Pet requirement',
            'pet.pet_deposit' => 'Pet deposit',
            'pet.pet_monthly_rate' => 'Pet monthly rate',
            'maintenance.tenant_responsibilities' => 'Tenant responsibilities',
            'maintenance.land_lord_responsibilities' => 'Landlord responsibilities',
            'lead_paint.built_before_1978' => 'Built before 1978',
            'm2m.month_to_month_rent' => 'Month-to-month rent',
            'm2m.notice' => 'Month-to-month notice period',
            'non_renewal.notice_length' => 'Non-renewal notice length',
        ];
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
            'agreement.rent' => 'required|numeric|gt:0',
            'agreement.application_fee' => 'required|numeric|gt:0',
            'agreement.late_fee' => 'required|numeric|gt:0',
            'agreement.grace_period' => 'required|numeric|gt:0',
            'agreement.security_deposit' => 'required|numeric|gt:0',
            'pet.pets_allowed' => 'required|in:1,0',
            'pet.requirement' => 'string|nullable',
            'pet.pet_deposit' => 'numeric|nullable|gt:0',
            'pet.pet_monthly_rate' => 'numeric|nullable|gt:0',
            'maintenance.tenant_responsibilities' => 'string|nullable',
            'maintenance.land_lord_responsibilities' => 'string|nullable',
            'lead_paint.built_before_1978' => 'required|in:1,0',
            'm2m.month_to_month_rent' => 'required|numeric|gt:0',
            'm2m.notice' => 'required|numeric|min:0',
            'non_renewal.notice_length' => 'required|numeric|gt:0'
        ];
    }
}
