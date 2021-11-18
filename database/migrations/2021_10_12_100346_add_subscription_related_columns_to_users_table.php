<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriptionRelatedColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_customer_id')->nullable();
            $table->string('stripe_current_subscription_id')->nullable();
            $table->string('stripe_next_subscription_id')->nullable();
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_plan_id')->nullable();
            $table->string('stripe_default_payment_method')->nullable();
            $table->timestamp('subscribed_on')->nullable();
            $table->timestamp('current_period_start')->nullable();
            $table->timestamp('current_period_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('stripe_customer_id');
            $table->dropColumn('stripe_current_subscription_id');
            $table->dropColumn('stripe_next_subscription_id');
            $table->dropColumn('stripe_product_id');
            $table->dropColumn('stripe_plan_id');
            $table->dropColumn('stripe_default_payment_method');
            $table->dropColumn('subscribed_on');
            $table->dropColumn('current_period_start');
            $table->dropColumn('current_period_end');
        });
    }
}
