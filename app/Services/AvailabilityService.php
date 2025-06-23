<?php

namespace App\Services;

use App\Http\Resources\AvailabilityCollection;
use App\Repositories\AvailabilityRepository;
use Illuminate\Support\Facades\Auth;

class AvailabilityService
{
    protected $availabilityRepo;

    public function __construct(AvailabilityRepository $availabilityRepo)
    {
        $this->availabilityRepo = $availabilityRepo;
    }

    /**
     * Get all availabilitys for authenticated user.
     *
     * @return AvailabilityCollection
     */
    public function getAllForAuthUser()
    {
        $userId = Auth::id();

        return new AvailabilityCollection($this->availabilityRepo->getByUserIdWithRelations($userId));
    }

    /**
     * Create availability for authenticated user.
     *
     * @param array $data
     * @return \App\Models\Availability
     */
    public function createForAuthUser(array $data)
    {
        $data['user_id'] = Auth::id();

        return $this->availabilityRepo->create($data);
    }
}
