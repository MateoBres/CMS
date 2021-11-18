<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItalianDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('italian_districts', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('codice')->nullable();
            $table->string('zona_nome')->nullable();
            $table->string('zona_codice')->nullable();
            $table->string('regione_codice')->nullable();
            $table->string('regione_nome')->nullable();
            $table->string('cm_codice')->nullable();
            $table->string('cm_nome')->nullable();
            $table->string('provincia_codice')->nullable();
            $table->string('provincia_nome')->nullable();
            $table->string('sigla')->nullable();
            $table->string('codice_catastale')->nullable();
            $table->string('popolazione')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('italian_districts');
    }
}
