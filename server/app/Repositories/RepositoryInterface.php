<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

/**
 *
 * Core Interface
 */
interface RepositoryInterface
{
    /**
     * Find the resource
     *
     * Find the first resource using its ID
     *
     * @param int $id ID of the resource
     * @return mixed $model;
     */
    public function find(int $id): mixed;

    /**
     * Return a collection
     *
     * Return a collection of all records of a resource
     *
     * @return Collection;
     */
    public function all(): Collection;

    public function paginate($perPage = 15);

    /**
     * Create a resource
     *
     * Pass an array data to the function to create a model
     * you can override to pass a request instead
     *
     * @param  $data
     * @return mixed $model
     */
    public function create($data): mixed;

    /**
     * Update a resource
     *
     * Find the specific resource that you passed in and update
     * the resource based on your submitted data
     *
     * @param  $model
     * @param mixed $data
     * @return mixed $model
     */
    public function update($model, mixed $data): mixed;

    /**
     * Destroy a resource
     *
     * Destroy the resource that you passed in
     *
     * @param $model
     * @return bool
     */
    public function destroy($model): bool;

    /**
     * Find a resource by the given slug
     *
     * Find a specific resource by finding the slug column in DB
     * make sure your model have a column named 'slug'
     *
     * @param string $slug
     * @return mixed $model
     */
    public function findBySlug(string $slug): mixed;

    /**
     * Clear the cache for this Repositories' Entity
     * @return bool
     */
    public function clearCache(): bool;

}
