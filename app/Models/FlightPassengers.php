<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightPassengers extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id', 'passenger_id', 'phone_number', 'email', 'born_on', 'title', 'gender', 'family_name', 'given_name', 'infant_passenger_id'
    ];

    public function booking()
    {
        return $this->belongsTo(FlightBookings::class);
    }

    public function identityDocuments()
    {
        return $this->hasOne(FlightIdentityDocuments::class);
    }
}
