<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Admin;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    // ── REGISTER ──────────────────────────────────────
    public function showRegister()
    {
        return view('auth.customer-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'email'       => 'required|email|unique:customers,email',
            'contact_num' => 'required|string|max:20',
            'password'    => 'required|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'contact_num' => $request->contact_num,
            'password'    => Hash::make($request->password),
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('booking')->with('success', 'Account created! You can now book an appointment.');
    }

    // ── LOGIN ─────────────────────────────────────────
    public function showLogin()
    {
        return view('auth.customer-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Check admin credentials first
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        // Then check customer credentials
        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('booking')->with('success', 'Welcome back, ' . Auth::guard('customer')->user()->name . '!');
        }

        return back()->withErrors(['email' => 'Incorrect email or password.'])->withInput();
    }

    // ── LOGOUT ────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.login')->with('success', 'You have been logged out.');
    }

    // ── BOOKING HISTORY ───────────────────────────────
    public function history()
    {
        $customer = Auth::guard('customer')->user();

        $appointments = Appointment::with(['stylist', 'services'])
            ->where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('auth.customer-history', compact('appointments', 'customer'));
    }
}