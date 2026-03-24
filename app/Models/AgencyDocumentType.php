<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyDocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'document_name',
        'display_name',
        'description',
        'is_required',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get the agency that owns the document type.
     */
    public function agency()
    {
        return $this->belongsTo(BusAgency::class, 'agency_id');
    }

    /**
     * Scope to get only active document types.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get only required document types.
     */
    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    /**
     * Scope to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
} 
