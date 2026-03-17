<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'bus_number',
        'total_seats',
        'layout_id',
        'status',
        'bus_type',
        'name'
    ];

    public function agency()
    {
        return $this->belongsTo(BusAgencies::class, 'agency_id');
    }

    public function schedules()
    {
        return $this->hasMany(BusSchedule::class, 'bus_id');
    }

    public function seatLayout()
    {
        return $this->belongsTo(BusSeatLayout::class, 'layout_id');
    }

    public function layout()
    {
        return $this->belongsTo(BusSeatLayout::class, 'layout_id');
    }
} 