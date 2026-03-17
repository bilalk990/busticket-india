<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking_modifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('old_schedule_id');
            $table->unsignedBigInteger('new_schedule_id');
            $table->string('reason');
            $table->text('comment')->nullable();
            $table->decimal('price_difference', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bus_bookings')->onDelete('cascade');
            $table->foreign('old_schedule_id')->references('id')->on('bus_schedules')->onDelete('cascade');
            $table->foreign('new_schedule_id')->references('id')->on('bus_schedules')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_modifications');
    }
}; 