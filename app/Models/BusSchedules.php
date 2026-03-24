<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bus;

class BusSchedules extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'route_id', 'departure_date', 'departure_time', 'price', 'agency_id', 'busfare_id',
        'arrival_time', 'status'];

    public function bookings()
    {
        return $this->hasMany(BusBookings::class);
    }
    public function agency()
    {
        return $this->belongsTo(BusAgency::class, 'agency_id');
    }

    public function route()
    {
        return $this->belongsTo(BusRoutes::class, 'route_id');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
    public function fare()
    {
        return $this->hasOne(BusFare::class, 'route_id');
    }

    // public function route()
    // {
    //     return $this->belongsTo(BusRoutes::class);
    // }
    public function layout()
    {
        return $this->belongsTo(BusSeatLayout::class, 'layout_id');
    }

    public function busAccessPoints()
{
    return $this->hasManyThrough(
        BusAccessPoints::class,
        BusRoutes::class,
        'id',
        'route_id',
        'route_id',
        'id'
    );
}


}
