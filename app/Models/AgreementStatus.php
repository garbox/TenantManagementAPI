<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgreementStatus extends Model
{
    protected $fillable = ['name', 'description'];

    // One AgreementStatus has many Agreements
    public function agreements(){
        return $this->hasMany(Agreement::class, 'agreement_status_id');
    }
}
