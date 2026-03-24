<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BusBooking extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'bus_schedule_id',
        'agency_id',
        'pickup',
        'dropoff',
        'coupon_code',
        'discount_amount',
        'final_price',
        'bookingreference',
        'qr_code',
        'contact_phone',
        'contact_email',
        'total_amount',
        'currency',
        'refund_amount',
        'status',
        'baggage_fee',
        'extra_bags_fee',
        'overweight_fee',
        'bags_per_passenger',
        'bag_weight',
        'markup_fee',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'refund_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_price' => 'decimal:2',
        'baggage_fee' => 'decimal:2',
        'extra_bags_fee' => 'decimal:2',
        'overweight_fee' => 'decimal:2',
        'bags_per_passenger' => 'integer',
        'bag_weight' => 'decimal:2',
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
        return $this->belongsTo(BusSchedules::class, 'bus_schedule_id');
    }

    /**
     * Get the passengers for the booking.
     */
    public function passengers()
    {
        return $this->hasMany(\App\Models\BusPassengers::class, 'booking_id');
    }

    /**
     * Get the modification history for the booking.
     */
    public function modifications()
    {
        return $this->hasMany(BookingModification::class, 'booking_id');
    }

    /**
     * Get the cancellation record for the booking.
     */
    public function cancellation()
    {
        return $this->hasOne(BookingCancellation::class, 'booking_id');
    }

    /**
     * Get the refund record for the booking.
     */
    public function refund()
    {
        return $this->hasOne(Refund::class, 'booking_id');
    }

    /**
     * Get the pickup point for the booking.
     */
    public function pickupPoint()
    {
        return $this->belongsTo(BusPoint::class, 'pickup', 'name');
    }

    /**
     * Get the dropoff point for the booking.
     */
    public function dropoffPoint()
    {
        return $this->belongsTo(BusPoint::class, 'dropoff', 'name');
    }

    /**
     * Check if the booking is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if the booking can be modified.
     */
    public function canBeModified()
    {
        return $this->status === 'confirmed' && 
               strtotime($this->schedule->departure_date) > strtotime(now()->addHours(24));
    }

    /**
     * Check if the booking can be cancelled.
     */
    public function canBeCancelled()
    {
        return $this->status === 'confirmed' && 
               strtotime($this->schedule->departure_date) > strtotime(now()->addHours(12));
    }

    public function resale()
    {
        return $this->hasOne(TicketResale::class, 'booking_id');
    }

    public function getPickupNameAttribute()
    {
        // First try to get from relationship
        if ($this->pickupPoint) {
            return $this->pickupPoint->name;
        }
        
        // Fallback to direct column value
        return $this->pickup;
    }

    public function getDropoffNameAttribute()
    {
        // First try to get from relationship
        if ($this->dropoffPoint) {
            return $this->dropoffPoint->name;
        }
        
        // Fallback to direct column value
        return $this->dropoff;
    }

    public function tickets()
    {
        return $this->hasMany(\App\Models\Ticket::class, 'booking_id');
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->contact_email;
    }
} 
