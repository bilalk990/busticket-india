<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id',
        'departure_time',
        'arrival_time',
        'status'
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime'
    ];

    public function route()
    {
        return $this->belongsTo(BusRoute::class, 'route_id');
    }

    public function bookings()
    {
        return $this->hasMany(BusBooking::class, 'bus_schedule_id');
    }

    public function passengers()
    {
        return $this->hasMany(BusPassenger::class, 'schedule_id');
    }

    public function busfare()
    {
        return $this->belongsTo(BusFare::class, 'busfare_id');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
} 
