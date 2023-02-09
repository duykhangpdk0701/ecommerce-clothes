<?php

namespace App\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Core class of repository
 */
abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model An instance of the Eloquent Model
     */
    protected Model $model;

    /**
     * @param Model $model
     * @throws BindingResolutionException
     */
    public function __construct(Model $model)
    {
        $this->setModel();
    }

    abstract public function getModel();

    /**
     * @throws BindingResolutionException
     */
    public function setModel(): void
    {
        $this->model = app()->make($this->getModel());
    }

    /**
     * @inheritdoc
     */
    public function find(int $id): mixed
    {
        return $this->model->find($id);
    }

    /**
     * @inheritdoc
     */
    public function all(): Collection
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    public function paginate($perPage = 20)
    {
        return $this->model->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    /**
     * @inheritdoc
     */
    public function create($data): mixed
    {
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        $model->update($data);

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function destroy($model): bool
    {
        $result = $this->find($model->id);

        if ($result) {
            $result->delete();
            $model->delete();
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function findBySlug($slug): mixed
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * @inheritdoc
     * @return bool
     */
    public function clearCache(): bool
    {
        return true;
    }
}
