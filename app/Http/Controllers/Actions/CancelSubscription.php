<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Stripe\StripeClient as Stripe;

class CancelSubscription extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        $stripe = new Stripe(getenv('STRIPE_SECRET'));
        $subscription_id = $request->get('subscription_id');

        try {
            $canceled = $stripe->subscriptions->cancel($subscription_id);
            $this->resetUserStripeData($user);
            return response()->json([
                'success' => true,
                'message' => 'Subscription successfully canceled',
                'data' => [
                    'subscription' => $canceled,
                    'user' => User::find($user->id)
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Reset user's Stripe-related information.
     *
     * @param  User $user
     */
    public function resetUserStripeData(User $user) {
        $user->stripe_customer_id = null;
        $user->stripe_current_subscription_id = null;
        $user->stripe_next_subscription_id = null;
        $user->stripe_product_id = null;
        $user->stripe_plan_id = null;
        $user->current_period_end = Carbon::now()->toDateTimeString();
        $user->save();
    }
}
