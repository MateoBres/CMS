<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Stripe\StripeClient as Stripe;

class RetrieveSessionData extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $session_id = $request->get('session_id');
            $stripe = new Stripe(getenv('STRIPE_SECRET'));
            $session_data = $stripe->checkout->sessions->retrieve($session_id);
            $subscription = $stripe->subscriptions->retrieve($session_data->subscription);
            $customer = $stripe->customers->retrieve($session_data->customer);
            $user = User::where('email', $customer->email)->first();

            $this->updateUsersStripeData($user, $customer, $subscription);
    
            return response()->json([
                'success' => true,
                'message' => 'Stripe Session successfully retrieved, User information successfully updated',
                'data' => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ]);
        }
    }

    public function updateUsersStripeData(User $user, $stripe_customer, $stripe_subscription) {
        $user->stripe_customer_id = $stripe_customer->id;
        $user->stripe_current_subscription_id = $stripe_subscription->id;
        $user->stripe_next_subscription_id = $stripe_subscription->id;
        $user->stripe_product_id = $stripe_subscription->plan->product;
        $user->stripe_plan_id = $stripe_subscription->plan->id;
        $user->stripe_default_payment_method = $stripe_subscription->default_payment_method;
        $user->subscribed_on = Carbon::now()->toDateTimeString();
        $user->current_period_start = Carbon::createFromTimestamp($stripe_subscription->current_period_start)->toDateTimeString();
        $user->current_period_end = Carbon::createFromTimestamp($stripe_subscription->current_period_end)->toDateTimeString();
        $user->save();
    }
}
