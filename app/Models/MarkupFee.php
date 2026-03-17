<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarkupFee extends Model
{
    protected $table = 'markup_fees';
    public $timestamps = false;
    protected $fillable = [
        'label', 'value', 'currency', 'type', 'status', 'created_at', 'modified_at', 'updated_at'
    ];
} 