<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'footer',
        'email',
        'website_color',
        'driverapp_color',
        'adminpanel_color',
        'app_logo',
        'app_logo_small',
        'google_map_api_key',
        'is_social_media',
        'driver_radios',
        'user_ride_schedule_time_minute',
        'trip_accept_reject_driver_time_sec',
        'show_ride_without_destination',
        'show_ride_otp',
        'show_ride_later',
        'delivery_distance',
        'app_version',
        'web_version',
        'contact_us_address',
        'contact_us_phone',
        'contact_us_email',
        'minimum_deposit_amount',
        'minimum_withdrawal_amount',
        'referral_amount',
        'mapType',
        'driverLocationUpdate',
        'delivery_charge_parcel',
        'parcel_active',
        'parcel_per_weight_charge',
        'creer',
        'modifier',
        'senderId',
        'serviceJson'
    ];
} 
