<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRetailerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_retailer', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable()->unsigned();
            $table->bigInteger('retailer_id')->nullable()->unsigned();
            $table->timestamps();
            $table->index(['category_id', 'retailer_id']);

            $table->foreign('category_id')->references('id')->on('categories')->constrained()->onDelete('cascade');
            $table->foreign('retailer_id')->references('id')->on('retailers')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_retailer');
    }
}
