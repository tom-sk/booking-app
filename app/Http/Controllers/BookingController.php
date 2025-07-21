<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\BookingStatus;
use App\Services\BookingService;
use Inertia\Inertia;

class BookingController extends Controller
{
    protected $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    public function index()
    {
        $title = __('Bookings');
        $bookings = $this->bookingService->setRelations(['client', 'service'])->getAll();

        return Inertia::render('Bookings', compact('bookings', 'title'));
    }

    public function store(BookingRequest $request)
    {
        $newBooking = $request->validated();
        $newBooking['booking_status_id'] = BookingStatus::PENDING;
        $this->bookingService->create($newBooking);

        return back()->with('status', 'updated');
    }

    public function show(Booking $booking)
    {
        return new BookingResource($booking);
    }

    public function update(BookingRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        return new BookingResource($booking);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->json();
    }
}
