<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users_customers', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('avatar')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users_customers', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'email',
                'email_verified_at',
                'password',
                'remember_token',
                'provider',
                'provider_id',
                'avatar'
            ]);
        });
    }
}; 