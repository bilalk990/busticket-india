<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_bookings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'bus_schedule_id',
        'bookingreference',
        'contact_phone',
        'contact_email',
        'total_amount',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the rating for the booking.
     */
    public function rating()
    {
        return $this->hasOne(Rating::class, 'booking_id')->withDefault();
    }

    /**
     * Get the rating value for the booking.
     */
    public function getRatingValueAttribute()
    {
        return $this->rating ? $this->rating->rating : null;
    }

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(UsersCustomer::class, 'user_id');
    }

    /**
     * Get the schedule for the booking.
     */
    public function schedule()
    {
        return $this->belongsTo(BusSchedule::class, 'bus_schedule_id');
    }

    /**
     * Get the passengers for the booking.
     */
    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'booking_id');
    }

    /**
     * Check if the booking is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'confirmed';
    }
} 
