<?php

namespace App\Http\Controllers;

use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        $termsAndCondition = TermsAndCondition::orderBy('id', 'desc')->first();
        return view('terms-and-conditions.index', compact('termsAndCondition'));
    }
} 