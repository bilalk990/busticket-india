<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'privacy_policy',
        'statut',
        'career',
        'modifier',
        'updated_at',
    ];

    protected $casts = [
        'career' => 'datetime',
        'modifier' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $table = 'privacy_policy';
} 