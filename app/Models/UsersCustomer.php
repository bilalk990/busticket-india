<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class UsersCustomer extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, MustVerifyEmailTrait;

    protected $table = 'users_customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'email_verified_at',
        'email_verification_sent_at',
        'provider',
        'provider_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_verification_sent_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the bookings for the customer.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    /**
     * Get the ratings for the customer.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        \Log::info('sendEmailVerificationNotification called for user: ' . $this->email);
        
        // Check if we've sent a verification email recently (within 1 minute)
        if ($this->email_verification_sent_at && $this->email_verification_sent_at->diffInMinutes(now()) < 1) {
            \Log::info('Skipping email verification - sent recently for user: ' . $this->email);
            return;
        }
        
        $this->update(['email_verification_sent_at' => now()]);
        $this->notify(new \App\Notifications\VerifyEmailNotification);
        \Log::info('VerifyEmailNotification sent for user: ' . $this->email);
    }
} 
