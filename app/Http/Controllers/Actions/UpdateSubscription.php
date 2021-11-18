<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Stripe\StripeClient as Stripe;

class UpdateSubscription extends Controller
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
        $new_plan_id = $request->get('new_plan_id');
        
        $subscription = $stripe->subscriptions->retrieve($subscription_id);
        $current_si_id = $subscription->items->first()->id;

        try {
            $updated = $stripe->subscriptions->update($subscription_id, [
                'items' => [
                    [
                        'id' => $current_si_id,
                        'deleted' => true,
                    ],
                    [
                        'price' => $new_plan_id,
                        'tax_rates' => [
                            getenv('STRIPE_TAX')
                        ]
                    ],
                ]
            ]);
            $this->updateUserStripeData($user, $updated);
    
            return response()->json([
                'success' => true,
                'message' => 'Subscription successfully updated',
                'data' => [
                  'subscription' => $updated,
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
     * Update user's Stripe-related data
     * 
     * @param User $user
     * @param Object $subscription
     */
    public function updateUserStripeData (User $user, $subscription)
    {
        $user->stripe_current_subscription_id = $subscription->id;
        $user->stripe_next_subscription_id = $subscription->id;
        $user->stripe_product_id = $subscription->plan->product;
        $user->stripe_plan_id = $subscription->plan->id;
        $user->current_period_start = Carbon::createFromTimeStamp($subscription->current_period_start)->toDateTimeString();
        $user->current_period_end = Carbon::createFromTimeStamp($subscription->current_period_end)->toDateTimeString();
        $user->save();
    }
}
