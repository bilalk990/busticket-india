<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoutes extends Model
{
    use HasFactory;

    protected $fillable = ['agency_id','origin', 'destination',];

    public function schedules()
    {
        return $this->hasMany(BusSchedules::class);
    }
    public function agency()
    {
        return $this->belongsTo(BusAgencies::class, 'agency_id');
    }

    public function fares()
{
    return $this->hasMany(BusFare::class, 'route_id');
}
}
