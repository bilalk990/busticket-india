<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBookings extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id', 'offer_id', 'currency', 'total_amount', 'tax_amount', 'status', 'booking_reference'
    ];

    public function contacts()
    {
        return $this->hasOne(FlightContacts::class);
    }

    public function passengers()
    {
        return $this->hasMany(FlightPassengers::class);
    }
}
