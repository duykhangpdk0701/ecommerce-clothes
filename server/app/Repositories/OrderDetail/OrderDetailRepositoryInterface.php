<?php

namespace App\Repositories\OrderDetail;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Order Detail Model
 */
interface OrderDetailRepositoryInterface extends RepositoryInterface
{
    public function getOrderDetail(array $params = []);
    public function getSumQuantityOrderDetail($orderId);

    /**
     * Server pagination
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($searchParams = null): LengthAwarePaginator;
}
