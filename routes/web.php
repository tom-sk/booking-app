<?php

use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Bookings
    Route::controller(BookingController::class)->group(function () {
        Route::get('/booking', 'index')->name('bookings');
        Route::get('/booking/store', 'store')->name('booking.store');
    });

    // Services
    Route::controller(ServiceController::class)->group(function () {
        Route::resource('service', ServiceController::class);
        Route::get('/new', 'new')->name('service.new');
    });

    // Clients
    Route::resource('/clients', ClientController::class);


    // Availability
    Route::controller(AvailabilityController::class)->group(function () {
        Route::resource('availability', AvailabilityController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
