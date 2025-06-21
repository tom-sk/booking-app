<?php

namespace App\Services;

use App\Http\Resources\ServiceCollection;
use App\Repositories\ServiceRepository;
use Illuminate\Support\Facades\Auth;

class ServiceService
{
    protected $serviceRepo;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepo = $serviceRepo;
    }

    /**
     * Get all services for authenticated user.
     *
     * @return ServiceCollection
     */
    public function getAllForAuthUser()
    {
        $userId = Auth::id();

        return new ServiceCollection($this->serviceRepo->getByUserIdWithRelations($userId));
    }

    /**
     * Store a new service for the authenticated user.
     *
     * @param array $data
     * @return mixed The created service model or whatever your repo returns
     */
    public function storeForAuthUser(array $data)
    {
        $data['user_id'] = Auth::id();

        return $this->serviceRepo->create($data);
    }
}
