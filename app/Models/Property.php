<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory; // Add this line to enable factory support

    protected $fillable = ['address', 'city', 'state_id', 'zip', 'property_owner_id'];
    protected $hidden = ['created_at', 'updated_at'];

    // Relationships
    public function agreements(): HasMany
    {
        return $this->hasMany(Agreement::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(PropertyOwner::class, 'property_owner_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }

    public function activeAgreement()
    {
        return $this->hasOne(Agreement::class)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }
}
