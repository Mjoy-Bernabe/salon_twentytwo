<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/services', function () {
//     return view('services'); 
// })->name('services');
Route::get('/services', function () {
    return view('services');
})->name('services.index'); 


Route::get('/booknow', function () {
    return view('booknow');
})->name('booknow');