<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'route_id',
        'seat_number',
        'status',
        'price',
        'currency'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(BusBooking::class, 'booking_id');
    }

    public function route()
    {
        return $this->belongsTo(BusRoute::class, 'route_id');
    }

    public function resale()
    {
        return $this->hasOne(TicketResale::class);
    }
} 
