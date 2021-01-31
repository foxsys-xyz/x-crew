<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunwaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runways', function (Blueprint $table) {
            $table->id();

            // Include Airport Runway Data.

            $table->string('icao');
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('surface')->nullable();
            $table->boolean('lighted')->nullable();
            $table->string('le_ident')->nullable();
            $table->string('le_elevation')->nullable();
            $table->string('le_heading')->nullable();
            $table->string('he_ident')->nullable();
            $table->string('he_elevation')->nullable();
            $table->string('he_heading')->nullable();

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
        Schema::dropIfExists('runways');
    }
}
