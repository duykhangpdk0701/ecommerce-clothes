<?php

namespace App\Repositories\ItemStock;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Brand Model
 */
interface ItemStockRepositoryInterface extends RepositoryInterface
{
    /**
     * Paginating, ordering and searching through pages for server side index table
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($searchParams = null): LengthAwarePaginator;

    /**
     * Get item stocks by itemIds.
     * @param $itemIds
     * @return mixed
     */
    public function getItemStocks($itemIds);

    /**
     * Get item stocks by conditions.
     * @param $itemIds
     * @return mixed
     */
    public function getItemsBySize($item_id, $size_id, $color_id, $price, $quantity, $direction = 'asc', $itemsIDExclude = [], $itemVariantId);


    /**
     * Get item stocks.
     * @param $itemIds
     * @return mixed
     */
    public function getItemStock(array $params = []);

    /**
     * Get item stock by supplier id
     * @param $supplierId
     * @return mixed
     */
    // public function getSupplierItems($supplierId);

    /**
     * @param $itemStockId
     * @return mixed
     */
    public function updateStockIn($itemStockId);

    /**
     * @param $itemIds
     * @return mixed
     */
    public function getItemsStockList($itemIds);

    /**
     * @param $contractId
     * @return mixed
     */
    public function getTotalItemsInContract($contractId);

    /**
     * Get the highest price for in stock items
     */
    public function getMaxInStockPrice();

    /**
     * Get the lowest price for in stock items
     */
    public function getMinInStockPrice();

    /**
     * Get the alternate in stock item stock by variant id and price
     *
     * @param integer $excludeId
     * @param integer $itemVariantId
     * @param decimal $price
     * @return App\Models\ItemStock
     */
    public function getInStockItemStockByVariant($excludeId, $itemVariantId, $price);

    /**
     * Get the partners from the in stock stocks with the same variants
     *
     * @param integer $itemVariantId
     * @return Collection
     */
    public function getPartnersFromInStockVariants($itemVariantId);

    public function getLastTenSaleProduct($itemId);

    public function getAvailableStockWithVariant($variantId);
}
