<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Stylist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $completedAppointments = Appointment::where('status', 'done')->with('services')->get();
        $revenue = $completedAppointments->sum(fn ($appointment) => $appointment->services->sum('price'));

        $activeStylists = Stylist::whereHas('schedules')->count();
        $totalCustomers = Customer::count();

        $topStylists = Stylist::withCount(['appointments' => function ($query) {
            $query->where('status', 'done');
        }])->orderByDesc('appointments_count')->take(3)->get();

        $filterType = $request->get('filter_type', 'year');
        $currentYear = Carbon::now()->year;
        $year = (int) $request->get('year', $currentYear);
        $month = (int) $request->get('month', Carbon::now()->month);

        $years = Appointment::where('status', 'done')
            ->select(DB::raw('YEAR(appointment_datetime) as year'))
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        if (! in_array($year, $years, true)) {
            $years[] = $year;
            rsort($years);
        }

        $months = collect(range(1, 12))->mapWithKeys(fn ($m) => [$m => Carbon::create()->month($m)->format('F')])->toArray();

        $chartLabels = [];
        $chartValues = [];
        $selectedRevenue = 0;
        $estimatedMonthlyIncome = 0;

        if ($filterType === 'month') {
            $period = Carbon::create($year, $month, 1);
            $daysInMonth = $period->daysInMonth;
            $chartLabels = range(1, $daysInMonth);

            $dailyRevenue = array_fill(1, $daysInMonth, 0);
            $appointments = Appointment::where('status', 'done')
                ->whereYear('appointment_datetime', $year)
                ->whereMonth('appointment_datetime', $month)
                ->with('services')
                ->get();

            foreach ($appointments as $appointment) {
                $day = Carbon::parse($appointment->appointment_datetime)->day;
                $dailyRevenue[$day] += $appointment->services->sum('price');
            }

            $chartValues = array_values($dailyRevenue);
            $selectedRevenue = array_sum($chartValues);

            if ($year === $currentYear && $month === Carbon::now()->month) {
                $today = Carbon::now()->day;
                $estimatedMonthlyIncome = $today > 0 ? ($selectedRevenue / $today) * $daysInMonth : 0;
            } else {
                $estimatedMonthlyIncome = $selectedRevenue;
            }
        } else {
            $chartLabels = array_values($months);
            $monthlyRevenue = array_fill(1, 12, 0);

            $appointments = Appointment::where('status', 'done')
                ->whereYear('appointment_datetime', $year)
                ->with('services')
                ->get();

            foreach ($appointments as $appointment) {
                $monthIndex = Carbon::parse($appointment->appointment_datetime)->month;
                $monthlyRevenue[$monthIndex] += $appointment->services->sum('price');
            }

            $chartValues = array_values($monthlyRevenue);
            $selectedRevenue = array_sum($chartValues);

            if ($year === $currentYear) {
                $monthsSoFar = max(1, Carbon::now()->month);
                $estimatedMonthlyIncome = $selectedRevenue / $monthsSoFar;
            } else {
                $estimatedMonthlyIncome = $selectedRevenue / 12;
            }
        }

        return view('admin.dashboard', compact(
            'revenue',
            'activeStylists',
            'totalCustomers',
            'topStylists',
            'filterType',
            'year',
            'month',
            'years',
            'months',
            'chartLabels',
            'chartValues',
            'selectedRevenue',
            'estimatedMonthlyIncome'
        ));
    }
}
