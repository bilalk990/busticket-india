<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class BusBookings extends Model
{
    use HasFactory;
    use HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'bus_schedule_id',
        'bookingreference',
        'tx_ref',
        'contact_phone',
        'contact_email',
        'total_amount',
        'status',
    ];

    public function schedule()
    {
        return $this->belongsTo(BusSchedules::class);
    }

    public function passengers()
{
    return $this->hasMany(BusPassengers::class);
}

}
