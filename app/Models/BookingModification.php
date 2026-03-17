<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingModification extends Model
{
    protected $fillable = [
        'booking_id',
        'old_schedule_id',
        'new_schedule_id',
        'reason',
        'comment',
        'price_difference',
    ];

    protected $casts = [
        'price_difference' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(BusBooking::class, 'booking_id');
    }

    public function oldSchedule()
    {
        return $this->belongsTo(BusSchedule::class, 'old_schedule_id');
    }

    public function newSchedule()
    {
        return $this->belongsTo(BusSchedule::class, 'new_schedule_id');
    }
} 