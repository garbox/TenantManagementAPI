<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetAddendum extends Model
{
    protected $fillable = ['pets_allowed', 'requirement', 'pet_deposit', 'pet_monthly_rate', 'agreement_id'];
    protected $hidden = ['agreement_id'];

    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }
}
