<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Admin;
use App\Models\Appointment;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    // ── FORGOT PASSWORD ───────────────────────────────
    public function showForgotPassword()
    {
        return view('auth.customer-forgot-password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors(['email' => 'Email not found.'])->withInput();
        }

        // Generate a 6-digit reset code
        $resetCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store the reset code with 1 hour expiration
        $customer->update([
            'reset_code' => $resetCode,
            'reset_code_expires_at' => now()->addHour(),
        ]);

        // Send email with reset code
        Mail::to($customer->email)->send(new PasswordResetMail($customer->name, $resetCode));

        return redirect()->route('customer.verify-reset-code')
            ->with('success', 'Reset code sent to your email!')
            ->with('email', $customer->email);
    }

    public function showResetPassword()
    {
        return view('auth.customer-reset-password');
    }

    public function verifyResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'reset_code' => 'required|string',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors(['email' => 'Email not found.'])->withInput();
        }

        if (!$customer->reset_code || $customer->reset_code !== $request->reset_code) {
            return back()->withErrors(['reset_code' => 'Invalid reset code.'])->withInput();
        }

        if ($customer->reset_code_expires_at < now()) {
            return back()->withErrors(['reset_code' => 'Reset code has expired.'])->withInput();
        }

        return redirect()->route('customer.new-password')
            ->with('success', 'Code verified! Set your new password.')
            ->with('email', $customer->email);
    }

    public function showNewPassword()
    {
        return view('auth.customer-new-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors(['email' => 'Email not found.'])->withInput();
        }

        // Update password and clear reset code
        $customer->update([
            'password' => Hash::make($request->password),
            'reset_code' => null,
            'reset_code_expires_at' => null,
        ]);

        return redirect()->route('customer.login')
            ->with('success', 'Password reset successfully! Please log in with your new password.');
    }
}