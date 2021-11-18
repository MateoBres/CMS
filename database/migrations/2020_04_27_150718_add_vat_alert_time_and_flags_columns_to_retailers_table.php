<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVatAlertTimeAndFlagsColumnsToRetailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retailers', function (Blueprint $table) {
            $table->string('vat', 11)->index();
            $table->integer('alert_time')->default(10);
            $table->integer('delivery_time')->default(10);
            $table->boolean('does_delivery')->default(false);
            $table->boolean('does_takeaway')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retailers', function (Blueprint $table) {
            $table->dropColumn('vat');
            $table->dropColumn('alert_time');
            $table->dropColumn('delivery_time');
            $table->dropColumn('does_delivery');
            $table->dropColumn('does_takeaway');
        });
    }
}
