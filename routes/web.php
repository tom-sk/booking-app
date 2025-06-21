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

// Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Bookings
Route::get('/booking', [BookingController::class, 'index'])->middleware(['auth', 'verified'])->name('bookings');
Route::get('/booking/store', [BookingController::class, 'store'])->middleware(['auth', 'verified'])->name('booking.store');
//Services
Route::get('/services', [ServiceController::class, 'index'])->middleware(['auth', 'verified'])->name('services');
Route::get('/services/new', [ServiceController::class, 'new'])->middleware(['auth', 'verified'])->name('service.new');
Route::get('/services/edit/{service}', [ServiceController::class, 'edit'])->middleware(['auth', 'verified'])->name('service.edit');
Route::post('/services/update/{service}', [ServiceController::class, 'update'])->middleware(['auth', 'verified'])->name('service.update');
Route::post('/services/store', [ServiceController::class, 'store'])->middleware(['auth', 'verified'])->name('service.store');
// Clients
Route::get('/clients', [ClientController::class, 'index'])->middleware(['auth', 'verified'])->name('clients');
//  Availability
Route::get('/availability', [AvailabilityController::class, 'index'])->middleware(['auth', 'verified'])->name('availability');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
