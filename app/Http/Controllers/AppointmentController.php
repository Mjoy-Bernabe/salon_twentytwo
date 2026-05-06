<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Show booking page
    public function index()
    {
        $services = Service::orderBy('service_name')->get()->unique('service_name')->values();
        $normalServices = $services->filter(fn ($service) => ! $service->is_promo);
        $cutNames = ['Haircut', 'Blow Dry', 'Curl Iron', 'Traditional Perm', 'Rebond'];
        $colourNames = ['Hair Color', 'Balayage', 'Highlights'];

        $serviceGroups = [
            'promos' => $services->filter(fn ($service) => $service->is_promo)->values(),
            'hair' => $normalServices->filter(fn ($service) => in_array($service->service_name, $cutNames))->values(),
            'colour' => $normalServices->filter(fn ($service) => in_array($service->service_name, $colourNames))->values(),
            'special' => $normalServices->filter(fn ($service) => ! in_array($service->service_name, array_merge($cutNames, $colourNames)))->values(),
        ];

        return view('booknow', [
            'serviceGroups' => $serviceGroups,
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
            'customer_id'          => Auth::guard('customer')->id(),
            'stylist_id'           => $request->stylist_id,
            'appointment_datetime' => now(),
            'status'               => 'pending',
            'downpayment_amount'   => 0
        ]);

        $appointment->services()->attach($request->service_id);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }
}
