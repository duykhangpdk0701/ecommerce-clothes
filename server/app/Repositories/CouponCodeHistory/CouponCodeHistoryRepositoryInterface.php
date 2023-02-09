<?php

namespace App\Repositories\CouponCodeHistory;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Coupon Code History Model
 */
interface CouponCodeHistoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Get coupon code history
     * @param array $params
     * @return mixed
     */
    public function getCouponCodeHistory(array $params = []);

    /**
     * Filter the request from the performance
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;
}
