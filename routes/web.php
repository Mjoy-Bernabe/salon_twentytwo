<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StylistController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController as AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\StylistController as AdminStylistController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/about',   function () { return view('about'); })->name('about');
Route::get('/gallery', function () { return view('gallery'); })->name('gallery');
Route::get('/contact', function () { return view('contact'); })->name('contact');

/*
|--------------------------------------------------------------------------
| Customer Auth (Guest only)
|--------------------------------------------------------------------------
*/
Route::get('/login',     [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/login',    [CustomerAuthController::class, 'login'])->name('customer.login.post');
Route::get('/register',  [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.post');
Route::post('/logout',   [CustomerAuthController::class, 'logout'])->name('customer.logout');

/*
|--------------------------------------------------------------------------
| Customer Protected Routes (must be logged in)
|--------------------------------------------------------------------------
*/
Route::middleware('customer.auth')->group(function () {
    Route::get('/booking',        [AppointmentController::class, 'index'])->name('booking');
    Route::get('/booknow',        [AppointmentController::class, 'index'])->name('booknow');
    Route::post('/appointments',  [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/stylists', [AppointmentController::class, 'getStylistsForService'])->name('appointments.stylists');
    Route::get('/appointments/schedules', [AppointmentController::class, 'getSchedulesForStylist'])->name('appointments.schedules');
    Route::get('/my-bookings',    [CustomerAuthController::class, 'history'])->name('customer.history');
});

/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
*/
Route::resource('services', ServiceController::class);

/*
|--------------------------------------------------------------------------
| Stylists
|--------------------------------------------------------------------------
*/
Route::resource('stylists', StylistController::class);

Route::get('/stylists/{id}/schedule',  [StylistController::class, 'schedule'])->name('stylists.schedule');
Route::post('/stylists/{id}/schedule', [StylistController::class, 'storeSchedule'])->name('stylists.schedule.store');

/*
|--------------------------------------------------------------------------
| Customers (Admin)
|--------------------------------------------------------------------------
*/
Route::resource('customers', CustomerController::class);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('services', AdminServiceController::class);

        Route::resource('stylists', AdminStylistController::class);
        Route::get('stylists/{id}/schedule', [AdminStylistController::class, 'schedule'])->name('stylists.schedule');
        Route::post('stylists/{id}/schedule', [AdminStylistController::class, 'storeSchedule'])->name('stylists.schedule.store');

        Route::resource('appointments', AdminAppointmentController::class);
        Route::post('appointments/{appointment}/confirm', [AdminAppointmentController::class, 'confirm'])->name('appointments.confirm');
        Route::post('appointments/{appointment}/cancel', [AdminAppointmentController::class, 'cancel'])->name('appointments.cancel');
        Route::post('appointments/{appointment}/done', [AdminAppointmentController::class, 'markDone'])->name('appointments.done');
    });
});