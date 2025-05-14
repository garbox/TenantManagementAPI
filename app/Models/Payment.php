<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User as ModelUser;

class Payment extends Model 
{
    protected $fillable = ['user_id', 'stripe_id', 'payment_id', 'amount'];

    public static function getStripeCustomerId(int $user_id){
        $user = ModelUser::find($user_id);
        return $user->createOrGetStripeCustomer();
    }
}
