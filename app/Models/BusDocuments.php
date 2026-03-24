<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusDocuments extends Model
{
    use HasFactory;
    protected $table = 'bus_identity_documents';
    protected $fillable = [
        'passenger_id',
        'type',
        'unique_identifier',
        'issuing_country_code',
        'expires_on',
    ];

    public function passenger()
    {
        return $this->belongsTo(BusPassengers::class);
    }
}
