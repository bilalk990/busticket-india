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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bus_bookings')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users_customers')->onDelete('cascade');
            $table->foreignId('agency_id')->constrained('bus_agencies')->onDelete('cascade');
            $table->integer('rating')->comment('Rating from 1 to 5');
            $table->text('comment')->nullable();
            $table->json('rating_details')->nullable()->comment('Additional rating details like cleanliness, comfort, etc.');
            $table->boolean('is_verified')->default(false)->comment('Whether the rating is from a verified trip');
            $table->boolean('is_public')->default(true)->comment('Whether the rating is visible to others');
            $table->timestamp('rated_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();

            // Indexes for better performance
            $table->index(['booking_id', 'user_id']);
            $table->index('rating');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
