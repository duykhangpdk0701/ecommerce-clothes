<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Order Model
 */
interface OrderRepositoryInterface extends RepositoryInterface
{
    /**
     * Get latest created order.
     * @return mixed
     */
    public function getLatest(): mixed;

    /**
     * Get order.
     * @param array $params
     * @return mixed
     */
    public function getOrder(array $params = []): mixed;

    /**
     * Filter the request from the api
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilterForUser(array $searchParams): LengthAwarePaginator;

    /**
     * Filter the request from the api
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilterForApi(array $searchParams): LengthAwarePaginator;

    /**
     * Get the order detail of the user by order code for api
     */
    public function getOrderDetailForApi($orderCode);
}
