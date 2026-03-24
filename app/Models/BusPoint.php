<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusPoint extends Model
{
    use HasFactory;

    protected $fillable = ['agency_id', 'name', 'iata_code', 'longitude', 'latitude'];

    public function faresAsPickup()
    {
        return $this->hasMany(BusFare::class, 'pickup');
    }

    public function faresAsDropoff()
    {
        return $this->hasMany(BusFare::class, 'dropoff');
    }
}
