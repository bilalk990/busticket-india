<?php

namespace App\Http\Controllers;

use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $email = $request->input('email');
            $type = $request->input('type', 'email'); // Get type from request, default to 'email'

            // Check if there's a recent OTP request (within 1 minute)
            $recentOtp = \App\Models\OtpVerification::where('type', $type)
                ->where('email', $email)
                ->where('created_at', '>', now()->subMinute())
                ->whereNull('verified_at');

            if ($recentOtp->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please wait at least 1 minute before requesting a new OTP'
                ], 429);
            }

            $otpVerification = $this->otpService->generateOtp($email, $type);

            Log::info("Email OTP sent successfully", [
                'email' => $email,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully. Please check your email.',
                'data' => [
                    'expires_at' => $otpVerification->expires_at,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error("Failed to send email OTP", [
                'error' => $e->getMessage(),
                'email' => $request->input('email'),
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Check if it's a mail-related error
            if (str_contains($e->getMessage(), '550') || str_contains($e->getMessage(), 'mail server')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to send OTP to this email address. Please check the email address and try again.'
                ], 400);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again later.'
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'otp.required' => 'OTP is required',
            'otp.size' => 'OTP must be 6 digits',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $email = $request->input('email');
            $otp = $request->input('otp');
            $type = $request->input('type', 'email'); // Get type from request, default to 'email'

            $result = $this->otpService->verifyOtp($email, $otp, $type);

            if ($result['success']) {
                Log::info("Email OTP verification successful", [
                    'email' => $email,
                    'ip' => $request->ip(),
                ]);
            } else {
                Log::warning("Email OTP verification failed", [
                    'email' => $email,
                    'ip' => $request->ip(),
                    'message' => $result['message'],
                ]);
            }

            return response()->json($result);

        } catch (\Exception $e) {
            Log::error("Email OTP verification error", [
                'error' => $e->getMessage(),
                'email' => $request->input('email'),
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred during verification. Please try again.'
            ], 500);
        }
    }

    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $email = $request->input('email');
            $type = $request->input('type', 'email'); // Get type from request, default to 'email'

            $result = $this->otpService->resendOtp($email, $type);

            if ($result['success']) {
                Log::info("Email OTP resent successfully", [
                    'email' => $email,
                    'ip' => $request->ip(),
                ]);
            }

            return response()->json($result);

        } catch (\Exception $e) {
            Log::error("Failed to resend email OTP", [
                'error' => $e->getMessage(),
                'email' => $request->input('email'),
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP. Please try again later.'
            ], 500);
        }
    }
}
