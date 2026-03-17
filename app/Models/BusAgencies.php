<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusAgencies extends Model
{
    use HasFactory;

    protected $fillable = ['agency_name', 'contact_email', 'contact_phone', 'address', 'agency_name', 'agency_type',
        'agency_registration_number', 'country_region', 'operating_routes',
        'agency_description', 'agency_logo'];

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
}
