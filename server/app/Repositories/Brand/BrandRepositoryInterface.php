<?php

namespace App\Repositories\Brand;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Brand Model
 */
interface BrandRepositoryInterface extends RepositoryInterface
{
    /**
     * Filter The Request
     *
     * @return Collection
     * @var array $searchParams
     */
    public function serverFilterFor(array $searchParams): Collection;

    /**
     * Filter the request from the api
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilterForApi(array $searchParams): LengthAwarePaginator;

    /**
     * Toggle status of the current resource
     *
     * @param $model
     */
    public function toggleStatus($model);
}

