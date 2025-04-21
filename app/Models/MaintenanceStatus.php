<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceStatus extends Model
{
    public function maintenances(): HasMany {
        return $this->hasMany(Maintenance::class);
    }
}
