<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bus_bookings')->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained('bus_schedules')->onDelete('cascade');
            $table->string('given_name');
            $table->string('family_name');
            $table->string('email');
            $table->string('phone');
            $table->date('dob');
            $table->string('gender');
            $table->string('seat');
            $table->decimal('seat_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}; 