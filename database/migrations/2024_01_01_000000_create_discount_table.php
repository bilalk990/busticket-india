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
        Schema::create('discount', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 1200);
            $table->string('discount', 1200);
            $table->string('type', 1200);
            $table->text('discription')->nullable();
            $table->string('coupon_type', 200);
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedInteger('route_id')->nullable();
            $table->integer('max_users')->nullable();
            $table->datetime('expire_at');
            $table->string('statut', 12);
            $table->datetime('creer');
            $table->datetime('modifier');
            $table->datetime('deleted_at')->nullable();
            
            // Indexes
            $table->index('agency_id');
            $table->index('route_id');
            $table->index('statut');
            $table->index('expire_at');
            
            // Foreign keys - commented out until bus_agencies and bus_routes tables exist
            // $table->foreign('agency_id')->references('id')->on('bus_agencies')->onDelete('set null');
            // $table->foreign('route_id')->references('id')->on('bus_routes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount');
    }
}; 