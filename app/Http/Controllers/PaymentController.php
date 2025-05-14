<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\Payment\PaymentConfirm;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Laravel\Cashier\Cashier;

class PaymentController extends Controller
{
    public function confirmPayment(PaymentConfirm $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->input('amount');
        $user_id = $request->input('user_id');
        $paymentMethodId = $request->input('payment_method_id');

        $stripeCustomerId = Payment::getStripeCustomerId($user_id);

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

                $user = User::find($user_id);
                Payment::create([
                    'user_id' => $user->id,
                    'stripe_id' => $user->stripe_id,
                    'payment_id' => $paymentIntent->id,
                    'amount' => $amount,
                ]);

                return response()->json(['message' => 'Payment successful!'], 200);
            } 
            
            else {
                Log::error('Payment failed', [
                    'user_id' => $user_id,
                    'amount' => $amount,
                    'payment_status' => $paymentIntent->status,
                ]);
                return response()->json(['error' => 'Payment failed'], 400);
            }
        } 
        
        catch (\Exception $e) {
            Log::error('Payment failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'An error occurred while processing your payment. Please try again later.'], 400);
        }
    }
}
