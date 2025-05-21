<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthToMonthAddendum extends Model
{
    protected $fillable = ['month_to_month_rent', 'notice', 'agreement_id'];
    protected $hidden = ['agreement_id'];
    
    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }
}
