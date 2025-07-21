<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingCollection;
use App\Http\Resources\ClientCollection;
use App\Services\BookingService;
use App\Services\ClientService;
use App\Services\ServiceService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $bookingService;
    protected $clientService;
    protected $serviceService;

    public function __construct(BookingService $bookingService, ClientService $clientService, ServiceService $serviceService)
    {
        $this->bookingService = $bookingService;
        $this->clientService = $clientService;
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        $title = 'Dashboard';
        $bookings = new BookingCollection($this->bookingService->forUser()->setRelations(['status', 'client', 'service'])->getAll());
        $clients = new ClientCollection($this->clientService->forUser()->setRelations(['bookings.status'])->getAll());
        $services = $this->serviceService->getAllForAuthUser();

        return Inertia::render('Dashboard', compact('bookings', 'title', 'clients', 'services'));
    }
}
