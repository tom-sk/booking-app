<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Services\BookingService;

class BookingRepository
{
    /**
     * Get bookings by user ID with relationships.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUserIdWithRelations(int $userId)
    {
        return Booking::with(['client', 'service'])
            ->where('user_id', $userId)
            ->orderBy('start_time', 'desc')
            ->get();
    }
}
