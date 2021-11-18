<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetCodeAddressDeliveryTimeAndStatusIdAsNullableOnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('address_id')->unsigned()->nullable(true)->change();
            $table->string('code')->nullable(true)->change();
            $table->dateTime('delivery_time', 0)->nullable(true)->change();
            $table->bigInteger('status_id')->unsigned()->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('address_id')->unsigned()->nullable(false)->change();
            $table->string('code')->nullable(false)->change();
            $table->dateTime('delivery_time', 0)->nullable(false)->change();
            $table->bigInteger('status_id')->unsigned()->nullable(false)->change();
        });
    }
}
