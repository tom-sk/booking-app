<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ServiceRepository extends BaseRepository
{
    /**
     * @param Service $model
     */
    public function __construct(Service $model)
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
        return Service::where('user_id', $userId)
            ->orderBy('start_time', 'desc')
            ->get();
    }
}
