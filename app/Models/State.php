<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    public static function abbr(int $state_id){
        return State::where('id', $state_id)->value('abbreviation');
    }

    public static function long(int $state_id){
        return State::where('id', $state_id)->value('name');
    }

    public static function allLong(){
        return State::pluck('name');
    }

    public static function allAbbr(){
        return State::pluck('abbreviation');
    }

    // relationships
    public function properties(): HasMany{
        return $this->hasMany(Property::class);
    }

        // relationships
        public function owners(): HasMany{
            return $this->hasMany(PropertyOwner::class);
        }
    
}