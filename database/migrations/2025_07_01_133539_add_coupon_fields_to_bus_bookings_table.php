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
        Schema::table('bus_bookings', function (Blueprint $table) {
            $table->string('coupon_code')->nullable()->after('dropoff');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('coupon_code');
            $table->decimal('final_price', 10, 2)->nullable()->after('discount_amount');
            
            // Add index for coupon code lookups
            $table->index('coupon_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bus_bookings', function (Blueprint $table) {
            $table->dropIndex(['coupon_code']);
            $table->dropColumn(['coupon_code', 'discount_amount', 'final_price']);
        });
    }
};
