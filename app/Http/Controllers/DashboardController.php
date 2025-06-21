<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingCollection;
use App\Services\BookingService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $title = 'Dashboard';
        $bookings = $this->bookingService->getAllForAuthUser();

        return Inertia::render('Dashboard', compact('bookings', 'title'));
    }
}
