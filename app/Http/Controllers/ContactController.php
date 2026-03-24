<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $countries = Country::orderBy('country_name')->get();
        return view('contact.index', compact('settings', 'countries'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email:rfc,dns|max:255',
                'phone' => 'nullable|string|max:20',
                'comments' => 'required|string|min:10'
            ], [
                'first_name.required' => 'Please enter your first name',
                'last_name.required' => 'Please enter your last name',
                'email.required' => 'Please enter your email address',
                'email.email' => 'Please enter a valid email address',
                'comments.required' => 'Please enter your message',
                'comments.min' => 'Your message must be at least 10 characters long'
            ]);

            // Create contact record
            $contact = Contact::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'message' => $validated['comments'],
                'status' => 'new'
            ]);

            // Get settings for admin email
            $settings = Setting::first();
            $adminEmail = $settings->email ?? config('mail.from.address');

            try {
                // Send email to admin
                Mail::send('emails.contact_admin', ['contact' => $contact], function ($message) use ($adminEmail, $contact) {
                    $message->to($adminEmail)
                            ->subject('New Contact Form Submission from ' . $contact->full_name);
                });

                // Send confirmation email to user
                Mail::send('emails.contact_confirmation', ['contact' => $contact], function ($message) use ($contact) {
                    $message->to($contact->email)
                            ->subject('Thank you for contacting us');
                });
            } catch (\Exception $e) {
                Log::error('Failed to send contact form emails: ' . $e->getMessage());
                // Continue with the success message even if email fails
            }

            return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Contact form submission failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Sorry, there was an error submitting your message. Please try again later.')
                ->withInput();
        }
    }
} 
