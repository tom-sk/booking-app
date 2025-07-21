<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var integer
     */
    protected $client_id = 0;
    /**
     * @var integer
     */
    protected $user_id = 0;

    /**
     * Eloquent model relations that should be loaded with the model by default
     *
     * @var array
     */
    protected $relations = [];

    /**
     * Eloquent model relation counts that should be loaded with the model by default
     *
     * @var array
     */
    protected $counts = [];

    /**
     * orderBy column
     * @var string
     */
    protected $order_by = 'id';

    /**
     * orderBy direction
     * @var string
     */
    protected $order_direction = 'desc';

    /**
     * orderBy direction
     * @var string
     */
    protected $per_page = 50;

    /**
     * limit
     * @var int
     */
    protected $limit = null;

    public function getAll(): Collection
    {
        $return = $this->model
            ->with($this->relations)
            ->get();

        return $return;
    }

    public function getAllPaginated(...$params): \Illuminate\Contracts\Pagination\LengthAwarePaginator
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

    /**
     * @inheritDoc
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(array $ids, array $attributes): Model
    {
        return $this->model->updateOrCreate($ids, $attributes);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function sync(Model $model, string $relation, array $relation_ids): array
    {
        return $model->$relation()->sync(array_filter($relation_ids));
    }

    /**
     * @inheritDoc
     */
    public function syncWithoutDetaching(Model $model, string $relation, array $relation_ids): array
    {
        return $model->$relation()->syncWithoutDetaching($relation_ids);
    }

    /**
     * @inheritDoc
     */
    public function attach(Model $model, string $relation, array $relation_ids): void
    {
        $model->$relation()->attach($relation_ids);
    }

    /**
     * @inheritDoc
     */
    public function detach(Model $model, string $relation, array $relation_ids): int
    {
        return $model->$relation()->detach($relation_ids);
    }

    /**
     * @inheritDoc
     */
    public function setRelations(array $relations = []): self
    {
        $this->relations = $relations;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCounts(array $counts = []): self
    {
        $this->counts = $counts;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setOrder(string $by, string $direction): self
    {
        $this->order_by = $by;
        $this->order_direction = $direction;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPerPage(int $per_page): self
    {
        $this->per_page = $per_page;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function forClient(int $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function forUser(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }
}
