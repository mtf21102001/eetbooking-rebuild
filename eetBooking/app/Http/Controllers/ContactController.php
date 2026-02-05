<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $recipient = env('ADMIN_EMAIL', 'web.dev@egyptexpresstvl.com');

        // Send Email
        Mail::to($recipient)->send(new ContactFormSubmitted($validated));

        return back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}
