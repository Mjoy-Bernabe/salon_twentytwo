<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Stylist;

class AdminController extends Controller
{
    public function index()
    {
        $completedAppointments = Appointment::where('status', 'done')->with('services')->get();
        $revenue = 0;
        foreach ($completedAppointments as $appointment) {
            $revenue += $appointment->services->sum('price');
        }

        $activeStylists = Stylist::whereHas('schedules')->count();
        $totalCustomers = Customer::count();

        return view('admin.dashboard', compact('revenue', 'activeStylists', 'totalCustomers'));
    }
}
