<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository
{
    /**
     * Get bookings by user ID with relationships.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUserIdWithRelations(int $userId)
    {
        return Service::where('user_id', $userId)
            ->orderBy('start_time', 'desc')
            ->get();
    }

    public function create(array $data)
    {
        return Service::create($data);
    }
}
