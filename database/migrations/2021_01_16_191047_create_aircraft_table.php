<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAircraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircraft', function (Blueprint $table) {
            $table->id();

            // Include Airframe Details.

            $table->char('icao', 4);
            $table->string('manufacturer');
            $table->string('model');
            $table->char('airline_icao', 3);
            $table->string('registration')->unique();
            $table->string('range');
            $table->string('mtow');
            $table->string('cruise');
            $table->string('maxpax');
            $table->string('maxcargo');

            // Add Airframe Status.

            $table->char('location', 4);

            // State Codes ['CLD/IDL', Cold & Dark | 'PFL/BKD' Preflight & Booked | 'IFL/ENR' In Flight & En-Route | 'MTN/IDL' Maintainance & Idle].

            $table->string('state')->nullable();
            $table->string('state_file')->nullable();
            $table->string('gate')->nullable();
            $table->string('pilot_comments')->nullable();

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
        Schema::dropIfExists('aircraft');
    }
}
