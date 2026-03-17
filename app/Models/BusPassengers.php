<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusPassengers extends Model
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
        'gender',
    ];

    public function booking()
    {
        return $this->belongsTo(BusBookings::class);
    }

    public function identityDocuments()
    {
        return $this->hasMany(BusDocuments::class, 'passenger_id');
    }
}
