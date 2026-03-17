<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusAgency extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_agencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agency_name',
        'agency_logo',
        'agency_description',
        'status'
    ];

    /**
     * Get the working hours for the bus agency.
     */
    public function workingHours()
    {
        return $this->hasMany(BusAgencyWorkingHour::class, 'bus_agency_id');
    }

    /**
     * Get the ratings for the bus agency.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'agency_id');
    }
} 