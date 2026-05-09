<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Mail::send('emails.contact', ['data' => $data], function ($message) use ($data) {
            $message
                ->to(config('mail.from.address'), config('mail.from.name'))
                ->replyTo($data['email'], $data['name'])
                ->subject('Salon TwentyTwo Contact: ' . $data['subject']);
        });

        return back()->with('success', 'Thank you. Your message has been sent.');
    }
}
