<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Maintenance extends Model
{
    use HasFactory; 
    
    protected $fillable = ['maintenance_type_id', 'user_id', 'property_id', 'description', 'assigned_to'];
    protected $hidden = [ 'created_at', 'updated_at'];

    public static function statusCount (){
        $statusCounts = Maintenance::select('maintenance_status_id')
        ->groupBy('maintenance_status_id')
        ->selectRaw('maintenance_status_id, COUNT(*) as count')
        ->with('status') // Eager load the status relationship
        ->get();

        return $statusCounts;
    }

    /* relationships */
    public function type(): BelongsTo {
        return $this->belongsTo(MaintenanceType::class, 'maintenance_type_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function expenses(): HasMany {
        return $this->hasMany(MaintenanceExpense::class);
    }

    public function property(): BelongsTo {
        return $this->belongsTo(Property::class);
    }

    public function status(): BelongsTo {
        return $this->belongsTo(MaintenanceStatus::class, 'maintenance_status_id', 'id');
    }

    public function assignedTo(){
        return $this->belongsTo(User::class, 'assigned_to');
    }

}
