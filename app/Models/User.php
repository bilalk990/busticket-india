<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table = 'users_customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider_id',
        'provider',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function bookings()
    {
        return $this->hasMany(BusBooking::class);
    }

    public function ticketResales()
    {
        return $this->hasMany(TicketResale::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
