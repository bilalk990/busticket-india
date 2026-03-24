<?php

namespace App\Console\Commands;

use App\Services\OtpService;
use Illuminate\Console\Command;

class CleanupExpiredOtps extends Command
{
    protected $signature = 'otp:cleanup';
    protected $description = 'Clean up expired OTP verification records';

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        parent::__construct();
        $this->otpService = $otpService;
    }

    public function handle()
    {
        $this->info('Starting OTP cleanup...');
        
        try {
            $deleted = $this->otpService->cleanupExpiredOtps();
            
            $this->info("Successfully cleaned up {$deleted} expired OTP records.");
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to cleanup expired OTPs: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
} 
