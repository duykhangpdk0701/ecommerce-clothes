<?php

namespace App\Repositories\OrderStatus;

use App\Repositories\RepositoryInterface;

/**
 * The repository interface for the Role Model
 */
interface OrderStatusRepositoryInterface extends RepositoryInterface
{
    /**
     * Check current status match.
     * @param $orderStatusBefore
     * @param $orderStatusAfter
     * @return mixed
     */
    public function checkOrderStatusByOrderFlow($orderStatusBefore,$orderStatusAfter);

    /**
     * Check order status to cancel
     * @param $orderStatus
     * @return mixed
     */
    public function checkOrderStatusToCancel($orderStatus);
}
