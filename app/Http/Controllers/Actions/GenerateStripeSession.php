<?php

namespace App\Http\Controllers\Actions;

use \Stripe\StripeClient as Stripe;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GenerateStripeSession extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        try {
            $stripe = new Stripe(getenv('STRIPE_SECRET'));
            $session = $stripe->checkout->sessions->create([
                'success_url' => $request->get('success_url'),
                'cancel_url' => $request->get('cancel_url'),
                'payment_method_types' => ['card'],
                'customer_email' => $user->email,
                'line_items' => [
                    [
                        'price' => $request->get('price'),
                        'quantity' => 1,
                        'tax_rates' => [
                            getenv('STRIPE_TAX')
                        ]
                    ],
                ],
                'mode' => 'subscription'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Stripe Checkout session successfully created',
                'data' => $session
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ]);
        }
    }
}
