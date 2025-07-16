<?php

namespace App\Services;

use App\Http\Resources\ClientCollection;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Auth\Access\AuthorizationException;
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

    /**
     * Update client if it belongs to authenticated user.
     *
     * @param Client $client
     * @param array $data
     * @return Client
     *
     * @throws AuthorizationException
     */
    public function update(Client $client, array $data): Client
    {
        if ($client->user_id !== Auth::id()) {
            throw new AuthorizationException('You do not own this client.');
        }

        // Remove user_id from data before update to avoid accidental overwrite
        unset($data['user_id']);

        $client->update($data);

        return $client;
    }
}
