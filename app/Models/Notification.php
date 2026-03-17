<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'message',
        'read_at',
    ];

    // Check if the notification is read
    // public function isRead()
    // {
    //     return !is_null($this->read_at);
    // }
}
