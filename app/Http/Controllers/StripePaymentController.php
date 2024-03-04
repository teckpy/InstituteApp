<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
use Exception;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(): View
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): RedirectResponse
    {
        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $stripe->paymentIntents->create([
                'amount' => 99 * 100,
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'description' => 'Demo payment with stripe',
                'confirm' => true,
                'receipt_email' => $request->email
            ]);
        } catch (CardException $th) {
            throw new Exception("There was a problem processing your payment", 1);
        }

        return back()->withSuccess('Payment done.');
    }
}
