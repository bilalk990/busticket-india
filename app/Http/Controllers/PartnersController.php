<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactSubmission;

class PartnersController extends Controller
{
    public function index()
    {
        $title = 'Become a Partner';
        $countries = Country::orderBy('country_name')->get();
        return view('partners_portal.index', compact('title', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:15',
            'company' => 'required|string|max:150',
            'url' => 'nullable|url|max:255',
            'country' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'comments' => 'nullable|string',
        ]);

        $submission = ContactSubmission::create($validated);

        $admin = "sunkatechnologies@gmail.com";
        // Send email to user
        Mail::send('emails.contact_submission', ['data' => $submission], function ($message) use ($submission) {
            $message->to($submission->email)
                    ->subject('Thank you for your interest in becoming a partner!');
        });

        // Send email to admin
        Mail::send('emails.contact_submission_admin', ['data' => $submission], function ($message) use ($admin) {
            $message->to($admin)
                    ->subject('New Partner Application');
        });

        return redirect()->route('partners_portal.status', ['id' => $submission->id]);
    }

    public function status($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        return view('partners_portal.status', compact('submission'));
    }
} 