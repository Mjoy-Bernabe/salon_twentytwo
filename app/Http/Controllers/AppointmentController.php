<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Show booking page
    public function index()
    {
        return view('booknow', [
            'services' => Service::all(),
            'stylists' => Stylist::all()
        ]);
    }

    // Save booking
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'stylist_id' => 'required|exists:stylists,id',
        ]);

        $appointment = Appointment::create([
            'customer_id'          => 1, // temporary, no login yet
            'stylist_id'           => $request->stylist_id,
            'appointment_datetime' => now(),
            'status'               => 'pending',
            'downpayment_amount'   => 0
        ]);

        $appointment->services()->attach($request->service_id);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }
}