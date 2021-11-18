<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ResetStripeProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:reset {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Stripe-related columns on specified user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();
        $user->stripe_customer_id = null;
        $user->stripe_current_subscription_id = null;
        $user->stripe_next_subscription_id = null;
        $user->stripe_product_id = null;
        $user->stripe_plan_id = null;
        $user->stripe_default_payment_method = null;
        $user->subscribed_on = null;
        $user->current_period_start = null;
        $user->current_period_end = null;
        $user->save();

        return 0;
    }
}
