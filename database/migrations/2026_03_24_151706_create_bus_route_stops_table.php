<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bus_route_stops', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('route_id'); // Changed from unsignedBigInteger
            $table->integer('stop_order');
            $table->string('stop_name');
            $table->enum('stop_type', ['origin', 'intermediate', 'destination'])->default('intermediate');
            $table->time('arrival_time')->nullable();
            $table->time('departure_time')->nullable();
            $table->integer('stop_duration_minutes')->default(5);
            $table->decimal('distance_from_previous', 10, 2)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key
            $table->foreign('route_id')->references('id')->on('bus_routes')->onDelete('cascade');
            
            // Indexes
            $table->index('route_id');
            $table->index(['route_id', 'stop_order']);
            $table->index('stop_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_route_stops');
    }
};
