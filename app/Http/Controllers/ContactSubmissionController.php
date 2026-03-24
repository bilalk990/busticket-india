<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactSubmissionController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'phone' => 'nullable|string|max:15',
        'company' => 'required|string|max:150',
        'url' => 'nullable|url|max:255',
        'country' => 'required|string|max:50',
        'address' => 'nullable|string|max:255',
        'comments' => 'nullable|string',
        // 'g-recaptcha-response' => 'required|captcha',
    ]);


    $submission = ContactSubmission::create($request->all());

    $admin = "sunkatechnologies@gmail.com";
    // Send email
    Mail::send('emails.contact_submission', ['data' => $submission], function ($message) use ($submission) {
        $message->to($submission->email)
                ->subject('Thank you for getting in touch!');
    });

    Mail::send('emails.contact_submission_admin', ['data' => $submission], function ($message) use ($admin) {
        $message->to($admin)
                ->subject('Potential Agency Partner!');
    });

    // Mail::send('emails.contact_submission', ['data' => $submission], function ($message) use ($submission) {
    //     $message->to($submission->email)
    //             ->cc('makalapeter@gmail.com')
    //             ->bcc('sunkatechnologies@gmail.com')
    //             ->subject('Thank you for getting in touch!');
    // });

    // Add a success message to the session
    return redirect()->back()->with('success', 'Your message has been sent successfully! We will contact you shortly.');
}

}

