<?php

namespace App\Repositories\ItemSize;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Brand Model
 */
interface ItemSizeRepositoryInterface extends RepositoryInterface
{
    /**
     * Paginating, ordering and searching through pages for server side index table
     * @param array $searchParams
     * @return Collection
     */
    public function serverFilteringFor(array $searchParams);

    /**
     * Filter the request from the api
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilterForApi(array $searchParams): LengthAwarePaginator;
}
