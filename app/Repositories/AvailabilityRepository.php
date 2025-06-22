<?php

namespace App\Repositories;

use App\Models\Availability;

class AvailabilityRepository
{
    /**
     * Get bookings by user ID with relationships.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUserIdWithRelations(int $userId)
    {
        return Availability::where('user_id', $userId)
            ->orderBy('day_of_week')
            ->get();
    }
}
