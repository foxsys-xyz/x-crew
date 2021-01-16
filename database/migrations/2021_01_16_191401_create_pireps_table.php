<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePirepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pireps', function (Blueprint $table) {
            $table->id();

            // Include Flight Data.

            $table->integer('user_id');
            $table->char('airline_icao', 3);
            $table->string('flightnum');
            $table->char('departure', 4);
            $table->char('arrival', 4);
            $table->text('route')->nullable();
            $table->integer('aircraft');
            $table->integer('load');
            $table->time('flight_time');
            $table->string('landing_rate');
            $table->string('fuel_used');
            $table->string('source');
            $table->longText('log');

            // Add PIREP Status.

            $table->timestamp('finalized_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();

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
        Schema::dropIfExists('pireps');
    }
}
