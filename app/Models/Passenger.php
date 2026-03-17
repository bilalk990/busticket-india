<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $table = 'bus_passengers';

    protected $fillable = [
        'booking_id',
        'schedule_id',
        'given_name',
        'family_name',
        'email',
        'phone',
        'dob',
        'gender',
        'seat',
        'seat_price',
    ];

    protected $casts = [
        'seat_price' => 'decimal:2',
        'dob' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(BusBooking::class, 'booking_id');
    }

    public function schedule()
    {
        return $this->belongsTo(BusSchedule::class, 'schedule_id');
    }
} 