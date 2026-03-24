<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public $uniqueFor = 60; // Unique for 60 seconds

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the unique ID for the notification.
     */
    public function uniqueId($notifiable)
    {
        return 'email_verification_' . $notifiable->id;
    }

    public function toMail($notifiable)
    {
        \Log::info('VerifyEmailNotification: Starting to build email for ' . $notifiable->email);
        
        try {
            $verificationUrl = $this->verificationUrl($notifiable);
            \Log::info('VerifyEmailNotification: Verification URL generated: ' . $verificationUrl);

            return (new MailMessage)
                ->subject('Verify Your Email Address - FastBuss Market')
                ->view('emails.verify-email', [
                    'notifiable' => $notifiable,
                    'verificationUrl' => $verificationUrl
                ]);
            
        } catch (\Exception $e) {
            \Log::error('VerifyEmailNotification: Error building email for ' . $notifiable->email . ': ' . $e->getMessage());
            throw $e;
        }
    }

    protected function verificationUrl($notifiable)
    {
        // Simple URL generation for local development
        return 'http://127.0.0.1:8000/email/verify/' . 
               $notifiable->getKey() . '/' . 
               sha1($notifiable->getEmailForVerification());
    }
} 
