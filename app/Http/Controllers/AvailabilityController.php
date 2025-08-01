<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailabilityRequest;
use App\Http\Resources\AvailabilityResource;
use App\Models\Availability;
use App\Services\AvailabilityService;
use Inertia\Inertia;

class AvailabilityController extends Controller
{
    protected $availabilityService;

    public function __construct(AvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    public function index()
    {
        $title = 'Availability';
        $availability = $this->availabilityService->getAllForAuthUser();

        return Inertia::render('Availability/Index', compact('availability', 'title'));
    }

    public function store(AvailabilityRequest $request)
    {
        $this->availabilityService->createForAuthUser($request->validated());

        return to_route('availability.index')
            ->with('success', 'Availability created successfully.');
    }

    public function show(Availability $availability)
    {
        return new AvailabilityResource($availability);
    }

    public function update(AvailabilityRequest $request, Availability $availability)
    {
        $availability->update($request->validated());
        return to_route('availability.index')
            ->with('success', 'Availability updated successfully.');
    }

    public function destroy(Availability $availability)
    {
        $availability->delete();

        return to_route('availability.index')
            ->with('success', 'Availability deleted.');
    }
}
