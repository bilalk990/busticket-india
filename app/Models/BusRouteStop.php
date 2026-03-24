<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRouteStop extends Model
{
    use HasFactory;

    protected $table = 'bus_route_stops';

    protected $fillable = [
        'route_id',
        'stop_order',
        'stop_name',
        'stop_type',
        'arrival_time',
        'departure_time',
        'stop_duration_minutes',
        'distance_from_previous',
        'latitude',
        'longitude',
        'address',
        'is_active',
    ];

    protected $casts = [
        'stop_order' => 'integer',
        'stop_duration_minutes' => 'integer',
        'distance_from_previous' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_active' => 'boolean',
    ];

    /**
     * Get the route that owns the stop
     */
    public function route()
    {
        return $this->belongsTo(BusRoutes::class, 'route_id');
    }

    /**
     * Scope to get only active stops
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by stop order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('stop_order', 'asc');
    }
}
