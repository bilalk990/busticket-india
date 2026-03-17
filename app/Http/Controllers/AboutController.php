<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $title = 'About Us - FastBuss';
        return view('about.index', compact('title'));
    }
} 