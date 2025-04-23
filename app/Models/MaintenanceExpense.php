<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceExpense extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'user_id', 'maintenance_id', 'expense', 'note'];

    public function request(): BelongsTo {
        return $this->belongsTo(Maintenance::class, 'maintenance_id');
    }
}
