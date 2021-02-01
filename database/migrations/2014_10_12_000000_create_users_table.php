<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Add Username.

            $table->string('username')->unique();

            // Include Personal Stuff.

            $table->string('fname');
            $table->string('lname');

            $table->string('avatar');
            $table->string('bio')->nullable();
            $table->boolean('rwp')->default(0);

            $table->string('email')->unique();
            $table->string('password');
            $table->date('dob');
            $table->char('country', 2);

            // Include Virtual Airline Stuff.
            
            $table->char('hub', 4);
            $table->boolean('status')->default(1);
            $table->boolean('staff')->default(0);

            // Include VATSIM Stuff.

            $table->integer('vatsim')->nullable()->unique();
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->unsignedBigInteger('token_expires')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
