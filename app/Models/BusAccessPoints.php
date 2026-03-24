<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusAccessPoints extends Model
{
    use HasFactory;
    protected $fillable = ['agency_id','route_id', 'pickup', 'dropoff'];

    public function route()
    {
        return $this->belongsTo(BusRoutes::class);
    }
      public function agency()
    {
        return $this->belongsTo(BusAgency::class);
    }

    public function fare()
    {
        return $this->hasOne(BusFare::class, 'bus_access_point_id');
    }



}
