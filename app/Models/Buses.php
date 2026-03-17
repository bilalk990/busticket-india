<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'agency_id',
        'layout_id',
        'facilities',
        'vin_number',
        'plate_number',
        'bus_type',
    ];
    protected $casts = [
        'facilities' => 'array',
    ];
    /**
     * Get the agency that owns the bus.
     */
    public function agency()
    {
        return $this->belongsTo(BusAgencies::class);
    }
    public function layout()
    {
        return $this->belongsTo(BusSeatLayout::class, 'layout_id');
    }

    public function facilities()
{
    return $this->belongsToMany(Facility::class, 'facilities', 'bus_id', 'facility_id');
}

}
