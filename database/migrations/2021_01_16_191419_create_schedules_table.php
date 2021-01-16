<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            // Include Schedules' Data.

            $table->char('airline_icao', 3);
            $table->string('flightnum');
            $table->char('departure', 4);
            $table->char('arrival', 4);
            $table->char('type', 1);
            $table->string('notes')->nullable();
            $table->char('aircraft_icao', 4);

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
        Schema::dropIfExists('schedules');
    }
}
