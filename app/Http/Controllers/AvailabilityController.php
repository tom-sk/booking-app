<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailabilityRequest;
use App\Http\Resources\AvailabilityResource;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    public function index()
    {
        return AvailabilityResource::collection(Availability::all());
    }

    public function store(AvailabilityRequest $request)
    {
        return new AvailabilityResource(Availability::create($request->validated()));
    }

    public function show(Availability $availability)
    {
        return new AvailabilityResource($availability);
    }

    public function update(AvailabilityRequest $request, Availability $availability)
    {
        $availability->update($request->validated());

        return new AvailabilityResource($availability);
    }

    public function destroy(Availability $availability)
    {
        $availability->delete();

        return response()->json();
    }
}
