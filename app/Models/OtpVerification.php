<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'otp',
        'type', // 'email' or 'phone'
        'attempts',
        'max_attempts',
        'expires_at',
        'verified_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
        'attempts' => 'integer',
        'max_attempts' => 'integer',
    ];

    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    public function isMaxAttemptsReached()
    {
        return $this->attempts >= $this->max_attempts;
    }

    public function isVerified()
    {
        return !is_null($this->verified_at);
    }

    public function incrementAttempts()
    {
        $this->increment('attempts');
        return $this;
    }

    public function markAsVerified()
    {
        $this->update(['verified_at' => now()]);
        return $this;
    }
} 