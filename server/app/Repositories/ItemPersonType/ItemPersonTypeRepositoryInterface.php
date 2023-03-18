<?php

namespace App\Repositories\ItemPersonType;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Brand Model
 */
interface ItemPersonTypeRepositoryInterface extends RepositoryInterface
{
    /**
     * Find the person type by code
     *
     * @param string $code
     * @return collection
     */
    public function findByCode($code);

    /**
     * Filter the request from the performance
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;
}
