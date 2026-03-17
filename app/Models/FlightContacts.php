<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightContacts extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id', 'email', 'phone_number'
    ];

    public function booking()
    {
        return $this->belongsTo(FlightBookings::class);
    }
}
