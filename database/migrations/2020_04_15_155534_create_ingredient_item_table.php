<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_item', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id')->unsigned();
            $table->bigInteger('ingredient_id')->unsigned();
            $table->timestamps();

            $table->index(['item_id', 'ingredient_id']);

            $table->foreign('item_id')->references('id')->on('items')->constrained()->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_table');
    }
}
