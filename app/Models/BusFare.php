<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusFare extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id', 'route_id', 'pickup', 'dropoff', 'amount',
        'currency', 'departure_time', 'arrival_time'
    ];

    public function route()
    {
        return $this->belongsTo(BusRoutes::class, 'route_id');
    }

    public function agency()
    {
        return $this->belongsTo(BusAgencies::class);
    }

    public function pickupPoint()
    {
        return $this->belongsTo(BusPoint::class, 'pickup', 'id');
    }

    public function dropoffPoint()
    {
        return $this->belongsTo(BusPoint::class, 'dropoff', 'id');
    }
}
