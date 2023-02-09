<?php

namespace App\Repositories\ItemCategory;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Brand Model
 */
interface ItemCategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Filter The Request
     *
     * @var array $searchParams
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function serverFilterFor(array $searchParams);

    /**
     * Filter the request from the api
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilterForApi(array $searchParams): LengthAwarePaginator;

    /**
     * Return a collection with parent categories with eager load children
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allParentWithChildren();

    /**
     * Return a collection of parent categories
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allParents();

    /**
     * Toggle status of the current resource
     *
     * @param $model
     */
    public function toggleStatus($model);
}
