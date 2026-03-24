<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UsersCustomer;
use Illuminate\Support\Facades\Hash;

class TestEmailVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email-verification {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the email verification system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'test@example.com';
        
        $this->info('Testing Email Verification System...');
        $this->newLine();

        // Check if user exists
        $user = UsersCustomer::where('email', $email)->first();
        
        if (!$user) {
            $this->warn("User with email {$email} not found. Creating test user...");
            
            $user = UsersCustomer::create([
                'name' => 'Test User',
                'email' => $email,
                'password' => Hash::make('password'),
            ]);
            
            $this->info("Test user created with ID: {$user->id}");
        } else {
            $this->info("Found existing user with ID: {$user->id}");
        }

        $this->newLine();
        
        // Check email verification status
        $this->info('Email Verification Status:');
        $this->line("Email: {$user->email}");
        $this->line("Verified: " . ($user->hasVerifiedEmail() ? 'Yes' : 'No'));
        $this->line("Verified At: " . ($user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i:s') : 'Not verified'));
        $this->line("Last Verification Email Sent: " . ($user->email_verification_sent_at ? $user->email_verification_sent_at->format('Y-m-d H:i:s') : 'Never sent'));

        $this->newLine();

        // Test sending verification email
        if ($this->confirm('Do you want to send a test verification email?')) {
            try {
                $user->sendEmailVerificationNotification();
                $this->info('✅ Verification email sent successfully!');
                $this->line("Email sent at: " . $user->fresh()->email_verification_sent_at->format('Y-m-d H:i:s'));
            } catch (\Exception $e) {
                $this->error('❌ Failed to send verification email: ' . $e->getMessage());
            }
        }

        $this->newLine();
        
        // Test verification methods
        $this->info('Testing verification methods:');
        $this->line("hasVerifiedEmail(): " . ($user->hasVerifiedEmail() ? 'true' : 'false'));
        $this->line("getEmailForVerification(): " . $user->getEmailForVerification());
        $this->line("getKey(): " . $user->getKey());

        $this->newLine();
        
        // Test verification URL generation
        $this->info('Verification URL Components:');
        $this->line("User ID: {$user->id}");
        $this->line("Email Hash: " . sha1($user->getEmailForVerification()));
        
        $this->newLine();
        
        $this->info('✅ Email verification system test completed!');
        
        if (!$user->hasVerifiedEmail()) {
            $this->warn('Note: User email is not verified. Use the verification link from the email to complete verification.');
        }
    }
}
