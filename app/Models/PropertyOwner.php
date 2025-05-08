<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyOwner extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id','phone', 'address', 'city', 'state_id', 'zip', 'dba'];
    protected $hidden = ['created_at', 'updated_at'];

    public function allProperties(int $owner_id){
        return PropertyOwner::find($owner_id)->properties;
    }

    public function allAgreements(int $owner_id){
        return PropertyOwner::with('properties', 'properties.agreements')->findOrFail($owner_id);
    }

    public function properties(): HasMany{
        return $this->hasMany(Property::class, 'owner_id');
    }

    public function state(): BelongsTo{
        return $this->belongsTo(State::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
