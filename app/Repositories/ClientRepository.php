<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    /**
     * Get bookings by user ID with relationships.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUserIdWithRelations(int $userId)
    {
        return Client::with(['bookings'])
            ->where('user_id', $userId)
            ->orderBy('start_time', 'desc')
            ->get();
    }
}
