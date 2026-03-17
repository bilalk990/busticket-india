<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketResale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'asking_price',
        'currency',
        'description',
        'status',
        'expires_at'
    ];

    protected $casts = [
        'asking_price' => 'decimal:2',
        'expires_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(BusBooking::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function activeBids()
    {
        return $this->bids()->where('status', 'pending');
    }
} 