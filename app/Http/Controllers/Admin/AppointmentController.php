<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Http\Request;
use App\Mail\AppointmentConfirmed;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index()
    {
        $query = Appointment::with(['customer', 'stylist', 'services']);

        if (request()->has('status') && request()->status !== '') {
            $query->where('status', request()->status);
        }

        $appointments = $query->paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $customers = Customer::all();
        $stylists = Stylist::all();
        $services = Service::all();

        return view('admin.appointments.create', compact('customers', 'stylists', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'stylist_id' => 'required|exists:stylists,id',
            'appointment_datetime' => 'required|date',
            'status' => 'required|in:pending,confirmed,done,cancelled',
            'downpayment_amount' => 'required|numeric|min:0',
            'service_ids' => 'required|array',
            'service_ids.*' => 'exists:services,id',
        ]);

        $appointment = Appointment::create([
            'customer_id' => $data['customer_id'],
            'stylist_id' => $data['stylist_id'],
            'appointment_datetime' => $data['appointment_datetime'],
            'status' => $data['status'],
            'downpayment_amount' => $data['downpayment_amount'],
        ]);

        $appointment->services()->sync($data['service_ids']);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $customers = Customer::all();
        $stylists = Stylist::all();
        $services = Service::all();
        $selectedServices = $appointment->services()->pluck('services.id')->toArray();

        return view('admin.appointments.edit', compact('appointment', 'customers', 'stylists', 'services', 'selectedServices'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'stylist_id' => 'required|exists:stylists,id',
            'appointment_datetime' => 'required|date',
            'status' => 'required|in:pending,confirmed,done,cancelled',
            'downpayment_amount' => 'required|numeric|min:0',
            'service_ids' => 'required|array',
            'service_ids.*' => 'exists:services,id',
        ]);

        $appointment->update([
            'customer_id' => $data['customer_id'],
            'stylist_id' => $data['stylist_id'],
            'appointment_datetime' => $data['appointment_datetime'],
            'status' => $data['status'],
            'downpayment_amount' => $data['downpayment_amount'],
        ]);

        $appointment->services()->sync($data['service_ids']);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->services()->detach();
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted.');
    }

    public function confirm(Appointment $appointment)
    {
        $appointment->update(['status' => 'confirmed']);

        // Load relationships needed for the email
        $appointment->load(['customer', 'stylist', 'services']);

        Mail::to($appointment->customer->email)
            ->send(new AppointmentConfirmed($appointment));

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment confirmed and email sent.');
    }

    public function cancel(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment cancelled.');
    }

    public function markDone(Appointment $appointment)
    {
        $appointment->update(['status' => 'done']);
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment marked as done.');
    }
}
