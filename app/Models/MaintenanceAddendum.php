<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceAddendum extends Model
{
    protected $fillable = ['tenant_responsibilities', 'land_lord_responsibilities', 'agreement_id'];
    protected $hidden = ['agreement_id'];
    
    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }
}
