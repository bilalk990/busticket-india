<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function careers()
    {
        return view('pages.careers');
    }

    public function helpCenter()
    {
        return view('pages.help-center');
    }

    public function faqs()
    {
        return view('pages.faqs');
    }

    public function ticketPolicies()
    {
        return view('pages.ticket-policies');
    }

    public function refundPolicy()
    {
        return view('pages.refund-policy');
    }
} 
