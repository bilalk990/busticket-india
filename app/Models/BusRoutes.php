<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoutes extends Model
{
    use HasFactory;

    protected $table = 'bus_routes';

    protected $fillable = [
        'agency_id',
        'origin',
        'destination',
        'route_name',
        'adult_price',
        'child_price',
        'distance',
        'status',
    ];

    public function schedules()
    {
        return $this->hasMany(BusSchedules::class);
    }
    public function agency()
    {
        return $this->belongsTo(BusAgency::class, 'agency_id');
    }

    public function fares()
    {
        return $this->hasMany(BusFare::class, 'route_id');
    }

    public function stops()
    {
        return $this->hasMany(BusRouteStop::class, 'route_id')->active()->ordered();
    }
}
