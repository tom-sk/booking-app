<?php

namespace App\Services;

use App\Http\Resources\ClientCollection;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Auth;

class ClientService
{
    protected $clientRepo;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    /**
     * Get all clients for authenticated user.
     *
     * @return ClientCollection
     */
    public function getAllForAuthUser()
    {
        $userId = Auth::id();

        return new ClientCollection($this->clientRepo->getByUserIdWithRelations($userId));
    }
}
