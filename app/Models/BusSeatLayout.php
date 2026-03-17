<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusSeatLayout extends Model
{
    use HasFactory;

    protected $fillable = ['agency_id','name', 'layout_type', 'total_seats', 'layout_json'];

    // protected $casts = [
    //     'layout_json' => 'array',
    // ];
}
