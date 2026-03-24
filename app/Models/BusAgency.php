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
        'contact_email',
        'contact_phone',
        'address',
        'agency_type',
        'agency_registration_number',
        'country_region',
        'operating_routes',
        'status',
        'is_active',
        'created_by'
    ];

    /**
     * Relationships
     */
    public function buses()
    {
        return $this->hasMany(Bus::class, 'agency_id');
    }

    public function routes()
    {
        return $this->hasMany(BusRoutes::class, 'agency_id');
    }

    public function schedules()
    {
        return $this->hasMany(BusSchedules::class, 'agency_id');
    }

    public function documentTypes()
    {
        return $this->hasMany(AgencyDocumentType::class, 'agency_id');
    }

    public function workingHours()
    {
        return $this->hasMany(BusAgencyWorkingHour::class, 'bus_agency_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'agency_id');
    }
}
