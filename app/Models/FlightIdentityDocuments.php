<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightIdentityDocuments extends Model
{
    use HasFactory;
    protected $fillable = [
        'passenger_id', 'unique_identifier', 'document_type', 'issuing_country_code', 'expires_on'
    ];

    public function passenger()
    {
        return $this->belongsTo(FlightPassengers::class);
    }
}
