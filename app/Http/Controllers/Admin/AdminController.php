<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->query('year', now()->year);
        $month = $request->query('month');

        // Revenue
        $completedAppointments = Appointment::where('status', 'done')->with('services')->get();
        $revenue = 0;
        foreach ($completedAppointments as $appointment) {
            $revenue += $appointment->services->sum('price');
        }

        // Top 3 stylists by completed appointments
        $topStylists = Stylist::withCount(['appointments as completed_appointments' => function ($query) {
            $query->where('status', 'done');
        }])
        ->orderByDesc('completed_appointments')
        ->limit(3)
        ->get();

        // Monthly income data
        $monthlyIncome = [];
        $monthlyIncomeData = [];
        
        for ($m = 1; $m <= 12; $m++) {
            $startDate = "$year-" . str_pad($m, 2, '0', STR_PAD_LEFT) . "-01";
            $endDate = date('Y-m-t', strtotime($startDate));
            
            $income = Appointment::where('status', 'done')
                ->whereBetween('appointment_datetime', [$startDate, $endDate])
                ->with('services')
                ->get()
                ->sum(function ($appointment) {
                    return $appointment->services->sum('price');
                });
            
            $monthlyIncome[date('M', strtotime($startDate))] = $income;
            $monthlyIncomeData[] = [
                'month' => $m,
                'income' => $income,
                'label' => date('M', strtotime($startDate))
            ];
        }

        // Estimated monthly income (average of last 3 months or all completed)
        $lastThreeMonths = array_slice($monthlyIncomeData, -3);
        $estimatedMonthly = count($lastThreeMonths) > 0 ? array_sum(array_column($lastThreeMonths, 'income')) / count($lastThreeMonths) : 0;

        $activeStylists = Stylist::whereHas('schedules')->count();
        $totalCustomers = Customer::count();

        return view('admin.dashboard', compact(
            'revenue', 
            'activeStylists', 
            'totalCustomers',
            'topStylists',
            'monthlyIncome',
            'monthlyIncomeData',
            'estimatedMonthly',
            'year'
        ));
    }
}
