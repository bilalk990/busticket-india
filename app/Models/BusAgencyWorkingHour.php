<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusAgencyWorkingHour extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_agency_working_hours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bus_agency_id',
        'day_of_week',
        'opening_time',
        'closing_time',
        'is_working_day'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_working_day' => 'boolean',
        'opening_time' => 'datetime',
        'closing_time' => 'datetime',
    ];

    /**
     * Get the bus agency that owns the working hours.
     */
    public function busAgency()
    {
        return $this->belongsTo(BusAgency::class, 'bus_agency_id');
    }
} 