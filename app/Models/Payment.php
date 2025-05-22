<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User as ModelUser;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Cashier;

class Payment extends Model
{
    protected $fillable = ['user_id', 'stripe_id', 'payment_id', 'amount'];

    public static function getStripeCustomerId(int $user_id)
    {
        $user = ModelUser::find($user_id);
        return $user->createOrGetStripeCustomer();
    }



    public function handlePaymentResult2($amount, $stripeCustomerId, $paymentMethodId, $user_id)
    {
        try {
            $paymentIntent = Cashier::stripe()->paymentIntents->create([
                'amount' => $amount,
                'currency' => 'usd',
                'customer' => $stripeCustomerId,
                'payment_method' => $paymentMethodId,
                'automatic_payment_methods' => [
                    'allow_redirects' => 'never',
                    'enabled' => true
                ],
                'confirm' => true,
            ]);

            if ($paymentIntent->status === 'succeeded') {
                Log::info("successfull");
                return $this->paymentSuccess($user_id, $paymentIntent, $amount);
            } 

        } catch (\Exception $e) {
            Log::error('Payment failed: ' . $e->getMessage(), ['exception' => $e]);
            return $e->getMessage();
        }
    }

    private function paymentSuccess($user_id, $paymentIntent, $amount)
    {
        $user = ModelUser::find($user_id);
        Payment::create([
            'user_id' => $user->id,
            'stripe_id' => $user->stripe_id,
            'payment_id' => $paymentIntent->id,
            'amount' => $amount,
        ]);

        return response()->json(true, 200);
    }
}
