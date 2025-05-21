<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\Payment\PaymentConfirm;
use App\Models\Payment;
use Stripe\Stripe;


class PaymentController extends Controller
{
    public function confirmPayment(PaymentConfirm $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payment = new Payment();
        $amount = $request->input('amount');
        $user_id = $request->input('user_id');
        $paymentMethodId = $request->input('payment_method_id');
        $stripeCustomerId = Payment::getStripeCustomerId($user_id);

        return $payment->handlePaymentResult2($amount, $stripeCustomerId, $paymentMethodId, $user_id);

    }
}
