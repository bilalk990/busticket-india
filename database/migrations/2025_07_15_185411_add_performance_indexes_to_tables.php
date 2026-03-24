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
        // Add indexes to bus_fares table
        Schema::table('bus_fares', function (Blueprint $table) {
            $table->index(['pickup', 'dropoff'], 'idx_bus_fares_pickup_dropoff');
            $table->index(['route_id', 'agency_id'], 'idx_bus_fares_route_agency');
            $table->index('amount', 'idx_bus_fares_amount');
        });

        // Add indexes to bus_bookings table
        Schema::table('bus_bookings', function (Blueprint $table) {
            $table->index(['contact_email', 'status'], 'idx_bus_bookings_email_status');
            $table->index('schedule_id', 'idx_bus_bookings_schedule');
            $table->index('created_at', 'idx_bus_bookings_created_at');
        });

        // Add indexes to bus_schedules table
        Schema::table('bus_schedules', function (Blueprint $table) {
            $table->index(['departure_date', 'status'], 'idx_bus_schedules_date_status');
            $table->index(['route_id', 'departure_date'], 'idx_bus_schedules_route_date');
            $table->index('bus_id', 'idx_bus_schedules_bus');
        });

        // Add indexes to bus_passengers table
        Schema::table('bus_passengers', function (Blueprint $table) {
            $table->index('schedule_id', 'idx_bus_passengers_schedule');
            $table->index('seat', 'idx_bus_passengers_seat');
        });

        // Add indexes to ratings table
        Schema::table('ratings', function (Blueprint $table) {
            $table->index('booking_id', 'idx_ratings_booking');
            $table->index('rating', 'idx_ratings_rating');
        });

        // Add indexes to ticket_resales table
        Schema::table('ticket_resales', function (Blueprint $table) {
            $table->index(['user_id', 'status'], 'idx_ticket_resales_user_status');
            $table->index('booking_id', 'idx_ticket_resales_booking');
            $table->index('created_at', 'idx_ticket_resales_created_at');
        });

        // Add indexes to bids table
        Schema::table('bids', function (Blueprint $table) {
            $table->index(['user_id', 'status'], 'idx_bids_user_status');
            $table->index('ticket_resale_id', 'idx_bids_resale');
            $table->index('created_at', 'idx_bids_created_at');
        });

        // Add indexes to bus_agencies table
        Schema::table('bus_agencies', function (Blueprint $table) {
            $table->index('agency_name', 'idx_bus_agencies_name');
        });

        // Add indexes to bus_routes table
        Schema::table('bus_routes', function (Blueprint $table) {
            $table->index(['origin', 'destination'], 'idx_bus_routes_origin_dest');
            $table->index('agency_id', 'idx_bus_routes_agency');
        });

        // Add indexes to bus_points table
        Schema::table('bus_points', function (Blueprint $table) {
            $table->index('name', 'idx_bus_points_name');
            $table->index(['latitude', 'longitude'], 'idx_bus_points_coords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove indexes from bus_fares table
        Schema::table('bus_fares', function (Blueprint $table) {
            $table->dropIndex('idx_bus_fares_pickup_dropoff');
            $table->dropIndex('idx_bus_fares_route_agency');
            $table->dropIndex('idx_bus_fares_amount');
        });

        // Remove indexes from bus_bookings table
        Schema::table('bus_bookings', function (Blueprint $table) {
            $table->dropIndex('idx_bus_bookings_email_status');
            $table->dropIndex('idx_bus_bookings_schedule');
            $table->dropIndex('idx_bus_bookings_created_at');
        });

        // Remove indexes from bus_schedules table
        Schema::table('bus_schedules', function (Blueprint $table) {
            $table->dropIndex('idx_bus_schedules_date_status');
            $table->dropIndex('idx_bus_schedules_route_date');
            $table->dropIndex('idx_bus_schedules_bus');
        });

        // Remove indexes from bus_passengers table
        Schema::table('bus_passengers', function (Blueprint $table) {
            $table->dropIndex('idx_bus_passengers_schedule');
            $table->dropIndex('idx_bus_passengers_seat');
        });

        // Remove indexes from ratings table
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropIndex('idx_ratings_booking');
            $table->dropIndex('idx_ratings_rating');
        });

        // Remove indexes from ticket_resales table
        Schema::table('ticket_resales', function (Blueprint $table) {
            $table->dropIndex('idx_ticket_resales_user_status');
            $table->dropIndex('idx_ticket_resales_booking');
            $table->dropIndex('idx_ticket_resales_created_at');
        });

        // Remove indexes from bids table
        Schema::table('bids', function (Blueprint $table) {
            $table->dropIndex('idx_bids_user_status');
            $table->dropIndex('idx_bids_resale');
            $table->dropIndex('idx_bids_created_at');
        });

        // Remove indexes from bus_agencies table
        Schema::table('bus_agencies', function (Blueprint $table) {
            $table->dropIndex('idx_bus_agencies_name');
        });

        // Remove indexes from bus_routes table
        Schema::table('bus_routes', function (Blueprint $table) {
            $table->dropIndex('idx_bus_routes_origin_dest');
            $table->dropIndex('idx_bus_routes_agency');
        });

        // Remove indexes from bus_points table
        Schema::table('bus_points', function (Blueprint $table) {
            $table->dropIndex('idx_bus_points_name');
            $table->dropIndex('idx_bus_points_coords');
        });
    }
};
