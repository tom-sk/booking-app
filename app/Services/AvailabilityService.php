<?php

namespace App\Services;

use App\Http\Resources\AvailabilityCollection;
use App\Repositories\AvailabilityRepository;
use Illuminate\Support\Facades\Auth;

class AvailabilityService
{
    protected $clientRepo;

    public function __construct(AvailabilityRepository $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    /**
     * Get all clients for authenticated user.
     *
     * @return AvailabilityCollection
     */
    public function getAllForAuthUser()
    {
        $userId = Auth::id();

        return new AvailabilityCollection($this->clientRepo->getByUserIdWithRelations($userId));
    }
}
