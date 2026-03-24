<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $paymentMethods = PaymentMethod::where('statut', 'yes')->get();
        return view('checkout.checkout', compact('paymentMethods'));
    }

}
