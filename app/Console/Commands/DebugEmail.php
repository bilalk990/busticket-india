<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DebugEmail extends Command
{
    protected $signature = 'debug:email {email?}';
    protected $description = 'Debug email configuration and test sending';

    public function handle()
    {
        $testEmail = $this->argument('email') ?? 'test@example.com';
        
        $this->info('🔍 Email Configuration Debug');
        $this->newLine();
        
        // Check configuration
        $this->info('📋 Current Configuration:');
        $this->line('Driver: ' . config('mail.default'));
        $this->line('Host: ' . config('mail.mailers.smtp.host'));
        $this->line('Port: ' . config('mail.mailers.smtp.port'));
        $this->line('Encryption: ' . config('mail.mailers.smtp.encryption'));
        $this->line('Username: ' . config('mail.mailers.smtp.username'));
        $this->line('From Address: ' . config('mail.from.address'));
        $this->line('From Name: ' . config('mail.from.name'));
        $this->line('APP_URL: ' . config('app.url'));
        
        $this->newLine();
        
        // Test email sending
        $this->info('📧 Testing Email Sending...');
        
        try {
            Mail::raw('This is a test email from FastBuss Market at ' . now(), function($message) use ($testEmail) {
                $message->to($testEmail)
                        ->subject('Email Test - FastBuss Market')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
            
            $this->info('✅ Email sent successfully!');
            $this->line("Check {$testEmail} for the test email.");
            
        } catch (\Exception $e) {
            $this->error('❌ Email sending failed!');
            $this->line('Error: ' . $e->getMessage());
            $this->newLine();
            
            // Common solutions
            $this->warn('🔧 Common Solutions:');
            $this->line('1. Check your SMTP credentials in .env file');
            $this->line('2. Try using TLS instead of SSL (port 587)');
            $this->line('3. Verify your hosting provider allows SMTP');
            $this->line('4. Check if your email provider requires app passwords');
            $this->line('5. Try using a different email service for testing');
            
            // Log the error
            Log::error('Email debug failed: ' . $e->getMessage(), [
                'exception' => $e,
                'config' => config('mail')
            ]);
        }
        
        $this->newLine();
        $this->info('🔍 Debug completed!');
    }
} 