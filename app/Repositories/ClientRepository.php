<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ClientRepository extends BaseRepository
{
    /**
     * @param Client $model
     */
    public function __construct(Client $model)
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
        return Client::with(['bookings'])
            ->where('user_id', $userId)
            ->orderBy('start_time', 'desc')
            ->get();
    }

    public function getAll(): Collection
    {
        return Client::with($this->relations)
            ->orderBy($this->order_by, $this->order_direction)
            ->get();
    }

    public function getAllPaginated(...$params): LengthAwarePaginator
    {
        // TODO: Implement getAllPaginated() method.
    }

    public function getById(int $id): ?Model
    {
        // TODO: Implement getById() method.
    }

    public function deleteAll(): bool
    {
        // TODO: Implement deleteAll() method.
    }

    public function applyOrder(Builder $query): Builder
    {
        // TODO: Implement applyOrder() method.
    }
}
