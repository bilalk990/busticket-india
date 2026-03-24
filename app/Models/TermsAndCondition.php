<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsAndCondition extends Model
{
    use HasFactory;

    protected $table = 'terms_and_conditions';

    protected $fillable = [
        'terms',
        'statut',
        'creer',
        'modifier',
        'updated_at',
    ];

    protected $casts = [
        'creer' => 'datetime',
        'modifier' => 'datetime',
        'updated_at' => 'datetime',
    ];
} 
