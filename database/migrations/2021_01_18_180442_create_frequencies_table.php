<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();

            // Include Airport Frequencies Data.

            $table->string('icao');
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->string('frequency')->nullable();

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
        Schema::dropIfExists('frequencies');
    }
}
