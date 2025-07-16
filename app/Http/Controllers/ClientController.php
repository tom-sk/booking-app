<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Services\ClientService;
use Inertia\Inertia;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        $clients = $this->clientService->getAllForAuthUser();

        return Inertia::render('Clients/Index', [
            'clients' => $clients,
        ]);
    }

    public function store(ClientRequest $request)
    {
        return new ClientResource(Client::create($request->validated()));
    }

    public function show(Client $client)
    {
        $client = new ClientResource($client);

        return Inertia::render('Clients/Show', [
            'client' => $client,
        ]);
    }

    public function update(Client $client, ClientRequest $request)
    {
        $updatedClient = $this->clientService->update($client, $request->validated());

        return redirect()->back()->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json();
    }
}
