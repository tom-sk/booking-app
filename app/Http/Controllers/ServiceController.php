<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\ClientService;
use App\Services\ServiceService;
use Inertia\Inertia;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }
    public function index()
    {
        $services = $this->serviceService->getAllForAuthUser();

        return Inertia::render('Services/Index', compact('services'));
    }

    public function new()
    {
        return Inertia::render('Services/New');
    }

    public function edit(Service $service)
    {
        return Inertia::render('Services/Edit', [
            'service' => new ServiceResource($service),
        ]);
    }

    public function store(ServiceRequest $request)
    {
        $this->serviceService->storeForAuthUser($request->validated());
        $services = $this->serviceService->getAllForAuthUser();

        return to_route('services.index')->with([
            'success' => 'Service created successfully.',]);
    }

    public function show(Service $service)
    {
        return Inertia::render('Services/Edit', [
            'service' => new ServiceResource($service),
        ]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->back()->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return to_route('service.index')
            ->with('success', 'Service deleted successfully.');
    }
}
