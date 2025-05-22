<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadPaintDisclosure extends Model
{
    protected $fillable = ['built_before_1978', 'agreement_id'];
    protected $hidden = ['agreement_id', 'created_at', 'updated_at'];
    
    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }
}
