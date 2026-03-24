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
            if (!Schema::hasColumn('bus_bookings', 'bookingreference')) {
                $table->string('bookingreference')->nullable()->after('agency_id');
            }
            if (!Schema::hasColumn('bus_bookings', 'contact_email')) {
                $table->string('contact_email')->nullable()->after('bookingreference');
            }
            if (!Schema::hasColumn('bus_bookings', 'contact_phone')) {
                $table->string('contact_phone')->nullable()->after('contact_email');
            }
            if (!Schema::hasColumn('bus_bookings', 'pickup')) {
                $table->string('pickup')->nullable()->after('contact_phone');
            }
            if (!Schema::hasColumn('bus_bookings', 'dropoff')) {
                $table->string('dropoff')->nullable()->after('pickup');
            }
            if (!Schema::hasColumn('bus_bookings', 'qr_code')) {
                $table->text('qr_code')->nullable()->after('dropoff');
            }
            if (!Schema::hasColumn('bus_bookings', 'currency')) {
                $table->string('currency', 10)->nullable()->default('USD')->after('total_amount');
            }
            if (!Schema::hasColumn('bus_bookings', 'final_price')) {
                $table->decimal('final_price', 10, 2)->nullable()->after('currency');
            }
            if (!Schema::hasColumn('bus_bookings', 'coupon_code')) {
                $table->string('coupon_code')->nullable()->after('final_price');
            }
            if (!Schema::hasColumn('bus_bookings', 'discount_amount')) {
                $table->decimal('discount_amount', 10, 2)->nullable()->default(0)->after('coupon_code');
            }
            if (!Schema::hasColumn('bus_bookings', 'refund_amount')) {
                $table->decimal('refund_amount', 10, 2)->nullable()->default(0)->after('discount_amount');
            }
            if (!Schema::hasColumn('bus_bookings', 'baggage_fee')) {
                $table->decimal('baggage_fee', 10, 2)->nullable()->default(0)->after('refund_amount');
            }
            if (!Schema::hasColumn('bus_bookings', 'extra_bags_fee')) {
                $table->decimal('extra_bags_fee', 10, 2)->nullable()->default(0)->after('baggage_fee');
            }
            if (!Schema::hasColumn('bus_bookings', 'overweight_fee')) {
                $table->decimal('overweight_fee', 10, 2)->nullable()->default(0)->after('extra_bags_fee');
            }
            if (!Schema::hasColumn('bus_bookings', 'bags_per_passenger')) {
                $table->integer('bags_per_passenger')->nullable()->default(0)->after('overweight_fee');
            }
            if (!Schema::hasColumn('bus_bookings', 'bag_weight')) {
                $table->decimal('bag_weight', 10, 2)->nullable()->default(0)->after('bags_per_passenger');
            }
            if (!Schema::hasColumn('bus_bookings', 'markup_fee')) {
                $table->decimal('markup_fee', 10, 2)->nullable()->default(0)->after('bag_weight');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bus_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'bookingreference', 'contact_email', 'contact_phone',
                'pickup', 'dropoff', 'qr_code', 'currency', 'final_price',
                'coupon_code', 'discount_amount', 'refund_amount',
                'baggage_fee', 'extra_bags_fee', 'overweight_fee',
                'bags_per_passenger', 'bag_weight', 'markup_fee',
            ]);
        });
    }
};
