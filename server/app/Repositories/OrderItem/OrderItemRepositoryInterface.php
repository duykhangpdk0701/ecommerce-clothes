<?php

namespace App\Repositories\OrderItem;

use App\Repositories\RepositoryInterface;

/**
 * The repository interface for the Role Model
 */
interface OrderItemRepositoryInterface extends RepositoryInterface
{
    public function countItemInOrder($orderId);
    public function getOrderItem(array $conditions = []);
    public function serverOrderItemCancelPaginationFilteringFor($searchParams = null);
    public function serverOrderItemPaginationFilteringFor($searchParams = null);
    public function getDueDebtItem($data = []);
    public function getItemStockDebtComplete($data);
    public function countCancelOrderItems($item_stock_ids, $orderId);
}
