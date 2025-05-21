<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Property;
use App\Models\AgreementStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Agreement extends Model
{
    use HasFactory;
    protected $fillable = ['tenant_id', 'property_id', 'file_name', 'security_deposit', 'rent', 'late_fee', 'grace_period', 'start_date', 'end_date', 'application_fee', 'agreement_status_id', 'lead_paint_disclosure_id', 'month_to_month_addendum_id', 'pet_addendum_id', 'maintenance_addendum_id', 'non_renewal_notice_addendum_id'];

    protected $hidden = ['created_at', 'updated_at', 'lead_paint_disclosure_id', 'month_to_month_addendum_id', 'pet_addendum_id', 'maintenance_addendum_id', 'non_renewal_notice_addendum_id'];

    public static function statusCount()
    {
        $statusCounts = Agreement::select('agreement_status_id')
            ->groupBy('agreement_status_id')
            ->selectRaw('agreement_status_id, COUNT(*) as count')
            ->with('status')
            ->get();

        return $statusCounts;
    }

    public static function addendumsCreate($data, $agreement_id)
    {
        $result = [];

        if ($leadData = $data->get('lead_paint')) {
            $leadData['agreement_id'] = $agreement_id;
            $lead = LeadPaintDisclosure::create($leadData);
            $result['lead_paint_disclosure_id'] = $lead->id;
        }

        if ($maintenanceData = $data->get('maintenance')) {
            $maintenanceData['agreement_id'] = $agreement_id;
            $maintenance = MaintenanceAddendum::create($maintenanceData);
            $result['maintenance_addendum_id'] = $maintenance->id;
        }

        if ($m2mData = $data->get('m2m')) {
            $m2mData['agreement_id'] = $agreement_id;
            $m2m = MonthToMonthAddendum::create($m2mData);
            $result['month_to_month_addendum_id'] = $m2m->id;
        }

        if ($nonRenewalData = $data->get('non_renewal')) {
            $nonRenewalData['agreement_id'] = $agreement_id;
            $nonRenewal = NonRenewalNoticeAddendum::create($nonRenewalData);
            $result['non_renewal_notice_addendum_id'] = $nonRenewal->id;
        }

        if ($petData = $data->get('pet')) {
            $petData['agreement_id'] = $agreement_id;
            $pet = PetAddendum::create($petData);
            $result['pet_addendum_id'] = $pet->id;
        }

        return $result;
    }

    public function getAddendumsAttribute()
    {
        return collect([
            $this->petAddendum,
            $this->leadPaintDisclosure,
            $this->maintenanceAddendum,
            $this->monthToMonthAddendum,
            $this->nonRenewalNoticeAddendum,
        ])->filter(); // Remove nulls
    }

    //relationships
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(AgreementStatus::class, 'agreement_status_id');
    }

    public function petAddendum(): HasOne
    {
        return $this->hasOne(PetAddendum::class);
    }

    public function nonRenewalAddendum(): HasOne
    {
        return $this->hasOne(NonRenewalNoticeAddendum::class);
    }

    public function monthToMonthAddendum(): HasOne
    {
        return $this->hasOne(MonthToMonthAddendum::class);
    }

    public function maintenanceAddendum(): HasOne
    {
        return $this->hasOne(MaintenanceAddendum::class);
    }

    public function leadPaintDisclosure(): HasOne
    {
        return $this->hasOne(LeadPaintDisclosure::class);
    }
}
