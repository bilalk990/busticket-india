<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'discount';

    // Use custom timestamp columns
    const CREATED_AT = 'creer';
    const UPDATED_AT = 'modifier';

    protected $fillable = [
        'code',
        'discount',
        'type',
        'discription',
        'coupon_type',
        'agency_id',
        'route_id',
        'max_users',
        'expire_at',
        'statut',
        'creer',
        'modifier'
    ];

    protected $casts = [
        'expire_at' => 'datetime',
        'creer' => 'datetime',
        'modifier' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function agency()
    {
        return $this->belongsTo(BusAgencies::class, 'agency_id');
    }

    public function route()
    {
        return $this->belongsTo(BusRoute::class, 'route_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('statut', 'yes')
                    ->where('expire_at', '>', now());
    }

    public function scopeValid($query)
    {
        return $query->where('expire_at', '>', now());
    }

    // Helper methods
    public function isExpired()
    {
        return $this->expire_at < now();
    }

    public function isActive()
    {
        return $this->statut === 'yes' && !$this->isExpired();
    }

    public function getDiscountAmount($originalPrice)
    {
        if (strtolower($this->type) === 'percentage') {
            return ($originalPrice * $this->discount) / 100;
        }
        
        return $this->discount;
    }

    public function getFormattedDiscount()
    {
        if (strtolower($this->type) === 'percentage') {
            return $this->discount . '%';
        }
        
        return $this->discount;
    }

    public function getDaysUntilExpiry()
    {
        return now()->diffInDays($this->expire_at, false);
    }

    public function getRouteDisplayName()
    {
        if ($this->route) {
            return $this->route->origin . ' → ' . $this->route->destination;
        }
        
        return 'All Routes';
    }
} 