<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Property;
use App\Models\AgreementStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agreement extends Model
{
    use HasFactory;
    protected $fillable = [ 'tenate_id', 'property_id', 'file_name', 'security_deposit', 'rent', 'start_date', 'end_date'];

    protected $hidden = [ 'created_at', 'updated_at'];

    public static function statusCount (){
        $statusCounts = Agreement::select('agreement_status_id')
        ->groupBy('agreement_status_id')
        ->selectRaw('agreement_status_id, COUNT(*) as count')
        ->with('status')
        ->get();    

        return $statusCounts;
    }

    //relationships
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'tenate _id');
    }

    public function property(): BelongsTo{
        return $this->belongsTo(Property::class);
    }

    // One Agreement belongs to one AgreementStatus
    public function status(): BelongsTo{
        return $this->belongsTo(AgreementStatus::class, 'agreement_status_id');
    }
}
