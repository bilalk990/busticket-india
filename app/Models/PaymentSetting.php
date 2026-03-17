<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;
     protected $table = 'payment_settings';
    protected $fillable = [
        'app_id', 'key', 'clientpublishableKey', 'secret_key', 'merchant_Id',
        'merchant_key', 'public_key', 'private_key', 'encryption_key',
        'tokenization_key', 'accesstoken', 'callback_url', 'webhook_url',
        'cancel_url', 'notify_url', 'return_url', 'isEnabled', 'isLive',
        'isSandboxEnabled', 'id_payment_method', 'username', 'password',
        'tax_type', 'tax_amount', 'creer', 'modifier', 'deleted_at'
    ];

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'id_payment_method', 'id');
    }
}
