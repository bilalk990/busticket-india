<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_id',
        'user_id',
        'agency_id',
        'rating',
        'comment',
        'rating_details',
        'is_verified',
        'is_public',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'rating_details' => 'array',
        'is_verified' => 'boolean',
        'is_public' => 'boolean',
        'rated_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
        'rated_at',
        'deleted_at',
    ];

    /**
     * Get the booking that owns the rating.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the user that owns the rating.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UsersCustomer::class, 'user_id');
    }

    /**
     * Get the agency that owns the rating.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(BusAgency::class, 'agency_id');
    }

    /**
     * Scope a query to only include verified ratings.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to only include public ratings.
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Get the rating text based on the numeric rating.
     */
    public function getRatingTextAttribute()
    {
        return match($this->rating) {
            1 => 'Poor',
            2 => 'Fair',
            3 => 'Good',
            4 => 'Very Good',
            5 => 'Excellent',
            default => 'Not Rated',
        };
    }

    /**
     * Get the formatted rating details.
     */
    public function getFormattedRatingDetailsAttribute()
    {
        if (!$this->rating_details) {
            return null;
        }

        $details = [];
        foreach ($this->rating_details as $key => $value) {
            $details[ucfirst(str_replace('_', ' ', $key))] = $value;
        }

        return $details;
    }
}
