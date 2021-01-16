<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Include Bookings Data.

            $table->integer('schedule_id')->unique();
            $table->integer('user_id')->unique();
            $table->integer('aircraft_id')->unique();
            $table->boolean('active')->default(0);

            // Add Schedule Times.

            $table->time('departure_at')->nullable();
            $table->time('duration')->nullable();
            $table->time('arrival_at')->nullable();

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
        Schema::dropIfExists('bookings');
    }
}
