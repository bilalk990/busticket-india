<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusBookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_middleware')
])->group(function () {
    Route::get('/bookings/email/{email}', [BusBookingController::class, 'getBookingsByEmail']);
    Route::get('/bookings/history/{email}', [BusBookingController::class, 'getTicketHistory']);
});

// OTP verification routes
Route::post('/otp/send', [App\Http\Controllers\OtpController::class, 'sendOtp']);
Route::post('/otp/verify', [App\Http\Controllers\OtpController::class, 'verifyOtp']);
Route::post('/otp/resend', [App\Http\Controllers\OtpController::class, 'resendOtp']);

// Health check endpoint for internet connectivity testing
Route::get('/health-check', function () {
    return response()->json([
        'status' => 'online',
        'timestamp' => now()->toISOString(),
        'message' => 'Application is running'
    ]);
}); 