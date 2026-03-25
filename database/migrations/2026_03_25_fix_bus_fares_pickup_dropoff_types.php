<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, delete any invalid records with empty or null values
        DB::statement("DELETE FROM bus_fares WHERE pickup = '' OR dropoff = '' OR pickup IS NULL OR dropoff IS NULL");
        
        // Now change the column types from varchar to integer
        // MySQL will automatically convert string numbers to integers
        Schema::table('bus_fares', function (Blueprint $table) {
            $table->unsignedInteger('pickup')->nullable(false)->change();
            $table->unsignedInteger('dropoff')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bus_fares', function (Blueprint $table) {
            $table->string('pickup', 255)->change();
            $table->string('dropoff', 255)->change();
        });
    }
};
