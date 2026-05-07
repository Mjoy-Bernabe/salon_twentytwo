<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // Show booking page
    public function index()
    {
        $services = Service::orderBy('service_name')->get()->unique('service_name')->values();
        $normalServices = $services->filter(fn ($service) => ! $service->is_promo);
        $cutNames = ['HAIRCUT', 'BLOW DRY', 'CURL IRON', 'TRADITIONAL PERM', 'REBOND'];
        $colourNames = ['HAIR COLOR', 'BALAYAGE', 'HIGHLIGHTS'];

        $serviceGroups = [
            'promos' => $services->filter(fn ($service) => $service->is_promo)->values(),
            'hair' => $normalServices->filter(fn ($service) => in_array(strtoupper($service->service_name), $cutNames))->values(),
            'colour' => $normalServices->filter(fn ($service) => in_array(strtoupper($service->service_name), $colourNames))->values(),
            'special' => $normalServices->filter(fn ($service) => ! in_array(strtoupper($service->service_name), array_merge($cutNames, $colourNames)))->values(),
        ];

        $defaultGroup = collect($serviceGroups)
            ->filter(fn ($group) => $group->isNotEmpty())
            ->keys()
            ->first() ?? 'promos';

        return view('booknow', [
            'serviceGroups' => $serviceGroups,
            'stylists' => collect(), // Start with empty collection, load dynamically
            'defaultGroup' => $defaultGroup,
        ]);
    }

    // Save booking
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'stylist_id' => 'required|exists:stylists,id',
            'appointment_datetime' => 'required|date|after:now',
            'downpayment_amount' => 'nullable|numeric|min:0',
        ]);

        // Additional validation: check if the time slot is still available
        $appointmentDateTime = \Carbon\Carbon::parse($request->appointment_datetime);
        $stylist = Stylist::find($request->stylist_id);
        
        // Check if stylist works on this day
        $dayName = $appointmentDateTime->format('l');
        $schedule = $stylist->schedules()->where('day', $dayName)->first();
        
        if (!$schedule) {
            return back()->withErrors(['appointment_datetime' => 'Stylist is not available on this day.']);
        }
        
        // Check if time is within working hours
        $appointmentTime = $appointmentDateTime->format('H:i:s');
        if ($appointmentTime < $schedule->start_time || $appointmentTime >= $schedule->end_time) {
            return back()->withErrors(['appointment_datetime' => 'Selected time is outside working hours.']);
        }
        
        // Check for conflicts (90-minute service duration)
        $serviceDuration = 90; // minutes
        $appointmentEnd = $appointmentDateTime->copy()->addMinutes($serviceDuration);

        $possibleConflicts = Appointment::where('stylist_id', $request->stylist_id)
            ->where('appointment_datetime', '<', $appointmentEnd)
            ->where('appointment_datetime', '>=', $appointmentDateTime->copy()->subMinutes($serviceDuration))
            ->get();

        $conflictingAppointment = $possibleConflicts->contains(function ($existing) use ($appointmentDateTime, $appointmentEnd, $serviceDuration) {
            $existingEnd = $existing->appointment_datetime->copy()->addMinutes($serviceDuration);

            return $appointmentDateTime < $existingEnd && $appointmentEnd > $existing->appointment_datetime;
        });

        if ($conflictingAppointment) {
            return back()->withErrors(['appointment_datetime' => 'This time slot is no longer available.']);
        }

        $appointment = Appointment::create([
            'customer_id'          => Auth::guard('customer')->id(),
            'stylist_id'           => $request->stylist_id,
            'appointment_datetime' => $appointmentDateTime,
            'status'               => 'pending',
            'downpayment_amount' => $request->input('downpayment_amount', 0)
        ]);

        $appointment->services()->attach($request->service_id);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    // Get stylists for a service
    public function getStylistsForService(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $service = Service::find($request->service_id);
        $stylists = $service->stylists;

        return response()->json($stylists);
    }

    // Get available schedules for a stylist
    public function getSchedulesForStylist(Request $request)
    {
        $request->validate([
            'stylist_id' => 'required|exists:stylists,id',
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer|min:2024|max:2030',
        ]);

        $stylist = Stylist::find($request->stylist_id);
        $schedules = $stylist->schedules;

       $month = (int) ($request->month ?? now()->month);
        $year  = (int) ($request->year  ?? now()->year);

        $startOfMonth = \Carbon\Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth   = \Carbon\Carbon::create($year, $month, 1)->endOfMonth();


        $existingAppointments = Appointment::where('stylist_id', $request->stylist_id)
            ->whereBetween('appointment_datetime', [$startOfMonth, $endOfMonth])
            ->with('services')
            ->get()
            ->map(function ($appointment) {
                $duration = 90; // Default 90 minutes, could be made dynamic
                $endTime = $appointment->appointment_datetime->copy()->addMinutes($duration);
                return [
                    'date' => $appointment->appointment_datetime->format('Y-m-d'),
                    'start' => $appointment->appointment_datetime->format('H:i'),
                    'end' => $endTime->format('H:i'),
                ];
            });

        // Generate calendar data
        $calendar = [];
        $firstDay  = \Carbon\Carbon::create($year, $month, 1);
        $lastDay   = \Carbon\Carbon::create($year, $month, 1)->endOfMonth();
        $startDate = $firstDay->copy()->startOfWeek(\Carbon\Carbon::SUNDAY); // ← fix
        $endDate   = $lastDay->copy()->endOfWeek(\Carbon\Carbon::SATURDAY);  // ← fix

        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dayName = $currentDate->format('l');
            $daySchedule = $schedules->where('day', $dayName)->first();

            $isAvailable = $daySchedule && $currentDate >= now()->startOfDay();
            $isCurrentMonth = $currentDate->month === $month;

            // Get booked times for this day
            $bookedTimes = $existingAppointments->where('date', $currentDate->format('Y-m-d'));

            $calendar[] = [
                'date' => $currentDate->format('Y-m-d'),
                'day' => $currentDate->day,
                'isAvailable' => $isAvailable,
                'isCurrentMonth' => $isCurrentMonth,
                'isToday' => $currentDate->isToday(),
                'dayName' => $dayName,
                'workingHours' => $daySchedule ? [
                    'start' => $daySchedule->start_time,
                    'end' => $daySchedule->end_time,
                ] : null,
                'bookedTimes' => $bookedTimes->values(),
            ];

            $currentDate->addDay();
        }

        return response()->json([
            'calendar' => $calendar,
            'month' => $month,
            'year' => $year,
            'monthName' => \Carbon\Carbon::create($year, $month, 1)->format('F'),
        ]);
    }
}
