<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NonRenewalNoticeAddendum extends Model
{
    protected $fillable =['notice_length', 'agreement_id'];
    protected $hidden =['agreement_id'];
    
    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }
}
