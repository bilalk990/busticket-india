<?php

namespace App\Services;

use App\Models\OtpVerification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OtpService
{
    public function generateOtp($email, $type = 'email')
    {
        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Expires in 10 minutes
        $expiresAt = Carbon::now()->addMinutes(10);
        
        // Create OTP record
        $otpVerification = OtpVerification::create([
            'email' => $email,
            'phone' => null,
            'otp' => $otp,
            'type' => $type,
            'expires_at' => $expiresAt,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Send email OTP
        $this->sendEmailOtp($email, $otp);

        Log::info("Email OTP generated for: {$email}", [
            'email' => $email,
            'type' => $type,
            'ip' => request()->ip(),
        ]);

        return $otpVerification;
    }

    public function verifyOtp($email, $otp, $type = 'email')
    {
        $otpVerification = OtpVerification::where('otp', $otp)
            ->where('type', $type)
            ->where('email', $email)
            ->where('expires_at', '>', Carbon::now())
            ->whereNull('verified_at')
            ->first();

        if (!$otpVerification) {
            Log::warning("Email OTP verification failed - invalid or expired OTP", [
                'email' => $email,
                'ip' => request()->ip(),
            ]);
            return ['success' => false, 'message' => 'Invalid or expired OTP'];
        }

        // Check if max attempts reached
        if ($otpVerification->isMaxAttemptsReached()) {
            Log::warning("Email OTP verification failed - max attempts reached", [
                'email' => $email,
                'attempts' => $otpVerification->attempts,
                'ip' => request()->ip(),
            ]);
            return ['success' => false, 'message' => 'Maximum verification attempts reached. Please request a new OTP.'];
        }

        // Increment attempts
        $otpVerification->incrementAttempts();

        // Mark as verified
        $otpVerification->markAsVerified();

        Log::info("Email OTP verification successful", [
            'email' => $email,
            'ip' => request()->ip(),
        ]);

        return ['success' => true, 'message' => 'Email OTP verified successfully'];
    }

    public function resendOtp($email, $type = 'email')
    {
        // Check if there's a recent OTP request (within 1 minute)
        $recentOtp = OtpVerification::where('type', $type)
            ->where('email', $email)
            ->where('created_at', '>', Carbon::now()->subMinute())
            ->whereNull('verified_at');

        if ($recentOtp->exists()) {
            return ['success' => false, 'message' => 'Please wait at least 1 minute before requesting a new OTP'];
        }

        // Generate new OTP
        return $this->generateOtp($email, $type);
    }

    private function sendEmailOtp($email, $otp)
    {
        try {
            Mail::send('emails.otp_verification', ['otp' => $otp], function ($message) use ($email) {
                $message->to($email)
                        ->subject('Your OTP Verification Code');
            });

            Log::info("Email OTP sent successfully", ['email' => $email]);
        } catch (\Exception $e) {
            Log::error("Failed to send email OTP", [
                'email' => $email,
                'error' => $e->getMessage()
            ]);
            throw $e; // Re-throw the exception so the calling method knows about the failure
        }
    }



    public function cleanupExpiredOtps()
    {
        $deleted = OtpVerification::where('expires_at', '<', Carbon::now())->delete();
        Log::info("Cleaned up {$deleted} expired OTP records");
        return $deleted;
    }
} 