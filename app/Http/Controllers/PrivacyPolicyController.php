<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacyPolicy = PrivacyPolicy::orderBy('id', 'desc')->first();
        return view('privacy-policy.index', compact('privacyPolicy'));
    }
} 