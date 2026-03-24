<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;

    protected $table = 'bus_routes';

    protected $fillable = [
        'agency_id',
        'origin',
        'destination',
        'route_name',
        'adult_price',
        'child_price',
        'distance',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function agency()
    {
        return $this->belongsTo(BusAgency::class, 'agency_id');
    }

    public function bookings()
    {
        return $this->hasMany(BusBooking::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'route_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Helper methods
    public function getRouteName()
    {
        return $this->origin . ' → ' . $this->destination;
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
} 
