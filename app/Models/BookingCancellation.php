<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCancellation extends Model
{
    protected $fillable = [
        'booking_id',
        'reason',
        'comment',
        'refund_amount',
        'refund_status',
        'refunded_at',
    ];

    protected $casts = [
        'refund_amount' => 'decimal:2',
        'refunded_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(BusBooking::class, 'booking_id');
    }
} 