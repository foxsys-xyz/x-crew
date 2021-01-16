<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();

            // Include Airports' General Data.

            $table->char('icao', 4)->unique();
            $table->char('iata', 3)->nullable();
            $table->string('airport_name');
            $table->string('city_name')->nullable();
            $table->string('country');
            $table->string('continent');

            // Include Airports' Geographical Data.

            $table->string('elevation')->nullable();
            $table->string('lat');
            $table->string('lng');

            // Add Airports' Status.

            $table->boolean('hub')->default(0);

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
        Schema::dropIfExists('airports');
    }
}
