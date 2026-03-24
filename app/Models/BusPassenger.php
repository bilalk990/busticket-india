<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusPassenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'schedule_id',
        'seat',
        'seat_price',
        'title',
        'given_name',
        'family_name',
        'email',
        'phone',
        'dob',
        'gender'
    ];

    protected $casts = [
        'seat_price' => 'decimal:2',
        'dob' => 'date'
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
