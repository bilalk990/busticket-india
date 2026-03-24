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
        Schema::table('ticket_resales', function (Blueprint $table) {
            $table->string('currency', 3)->default('ZMW')->after('asking_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_resales', function (Blueprint $table) {
            $table->dropColumn('currency');
        });
    }
};
