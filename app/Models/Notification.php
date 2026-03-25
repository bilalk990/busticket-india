<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data'     => 'array',
        'read_at'  => 'datetime',
    ];

    /** Scope to a specific user (or global if user_id is null) */
    public function scopeForUser($query, $userId)
    {
        // Check if user_id column exists in the table schema
        try {
            $columns = \Schema::getColumnListing('notifications');
            if (!in_array('user_id', $columns)) {
                // user_id column doesn't exist, return all notifications
                return $query;
            }
            
            return $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->orWhereNull('user_id');
            });
        } catch (\Exception $e) {
            // If any error occurs, return all notifications
            \Log::warning('Notification scopeForUser error: ' . $e->getMessage());
            return $query;
        }
    }

    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    public function user()
    {
        return $this->belongsTo(UsersCustomer::class, 'user_id');
    }
}
