<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Property;

class Agreement extends Model
{
    protected $fillable = [ 'user_id', 'property_id', 'file_name', 'security_deposit', 'rent', 'start_date', 'end_date'];

    protected $hidden = [ 'created_at', 'updated_at'];

    //relationships
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo{
        return $this->belongsTo(Property::class);
    }
}
