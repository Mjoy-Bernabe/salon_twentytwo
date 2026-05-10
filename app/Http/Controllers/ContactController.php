<?php

namespace App\Http\Controllers;

use App\Mail\ContactConfirmation;
use App\Mail\Contactemail;
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

        Mail::to(config('mail.from.address'), config('mail.from.name'))
            ->send(new Contactemail($data));

        Mail::to($data['email'], $data['name'])
            ->send(new ContactConfirmation($data));

        return back()->with('success', 'Thank you. Your message has been sent.');
    }
}
