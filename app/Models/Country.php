<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country_name',
        'iso2',
        'iso3',
        'region'
    ];

    public $timestamps = false;
} 