<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class BookingRepository extends BaseRepository
{
    /**
     * @param Booking $model
     */
    public function __construct(Booking $model)
    {
        $this->model = $model;
    }
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
