<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusBaggagePolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'max_bags_per_passenger',
        'max_weight_per_bag',
        'max_total_weight',
        'free_baggage_allowance',
        'extra_bag_fee',
        'overweight_fee_per_kg',
        'allowed_bag_types',
        'restricted_items',
        'policy_description',
        'is_active'
    ];

    protected $casts = [
        'max_bags_per_passenger' => 'integer',
        'max_weight_per_bag' => 'decimal:2',
        'max_total_weight' => 'decimal:2',
        'free_baggage_allowance' => 'integer',
        'extra_bag_fee' => 'decimal:2',
        'overweight_fee_per_kg' => 'decimal:2',
        'allowed_bag_types' => 'array',
        'restricted_items' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the agency that owns the baggage policy.
     */
    public function agency()
    {
        return $this->belongsTo(BusAgency::class, 'agency_id');
    }

    /**
     * Scope to get only active baggage policies.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Calculate extra baggage fee for additional bags.
     */
    public function calculateExtraBagFee($numberOfBags)
    {
        if ($numberOfBags <= $this->free_baggage_allowance) {
            return 0;
        }
        
        $extraBags = $numberOfBags - $this->free_baggage_allowance;
        return $extraBags * $this->extra_bag_fee;
    }

    /**
     * Calculate overweight fee for bags exceeding weight limit.
     */
    public function calculateOverweightFee($bagWeight)
    {
        if ($bagWeight <= $this->max_weight_per_bag) {
            return 0;
        }
        
        $overweight = $bagWeight - $this->max_weight_per_bag;
        return $overweight * $this->overweight_fee_per_kg;
    }

    /**
     * Check if a bag type is allowed.
     */
    public function isBagTypeAllowed($bagType)
    {
        if (empty($this->allowed_bag_types)) {
            return true; // If no restrictions, all types are allowed
        }
        
        return in_array($bagType, $this->allowed_bag_types);
    }

    /**
     * Check if an item is restricted.
     */
    public function isItemRestricted($item)
    {
        if (empty($this->restricted_items)) {
            return false; // If no restrictions, no items are restricted
        }
        
        return in_array($item, $this->restricted_items);
    }
} 
