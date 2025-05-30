<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Billable, HasFactory, Notifiable;

    protected $fillable = ['id', 'name', 'email', 'password', 'role_id', "stripe_customer_id"];

    protected $hidden = ['password', 'remember_token'];

    //set role ID to 3 be default if role_id isnt passed. 
    protected $attributes = [
        'role_id' => 3,
    ];

    public function __construct($user_id = null)
    {
        if ($user_id) {
            parent::__construct(self::findOrFail($user_id)->toArray());
        }
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    //relationships
    public function agreements(): HasMany
    {
        return $this->hasMany(Agreement::class, 'tenant_id');
    }

    public function latestAgreement()
    {
        return $this->hasOne(Agreement::class, 'tenant_id')->latest();
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }

    public function propertyOwner(): HasOne
    {
        return $this->hasOne(PropertyOwner::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'owner_id');
    }

    public function stripeCustomerId(): HasOne
    {
        return $this->hasOne(StripeCustomer::class);
    }
}
