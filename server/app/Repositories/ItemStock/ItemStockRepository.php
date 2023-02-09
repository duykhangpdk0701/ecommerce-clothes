<?php

namespace App\Repositories\ItemStock;

use App\Models\ItemStock;
use App\Repositories\BaseRepository;
use App\Repositories\Contract\ContractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * The repository for Item Stock Model
 */
class ItemStockRepository extends BaseRepository implements ItemStockRepositoryInterface
{
    /**
     * Paginate item per page
     */
    const ITEM_PER_PAGE = 10;

    /**
     * Limit item return data
     */
    const LIMIT_STOCK = 10;

    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * @var ContractRepository
     */
    protected $itemService;

    /**
     * @inheritdoc
     */
    public function __construct(
        ItemStock $model
    )
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return ItemStock::class;
    }

    /**
     * @param null $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $brand = Arr::get($searchParams, 'brand_id', '');
        $itemId = Arr::get($searchParams, 'item_id', '');
        $itemVariantId = Arr::get($searchParams, 'item_variant_id', '');
        $category = Arr::get($searchParams, 'item_category_id', '');
        $orderBy = Arr::get($searchParams, 'order_by', '');
        $fromPrice = Arr::get($searchParams, 'from_price', 0);
        $toPrice = Arr::get($searchParams, 'to_price', 0);
        $condition = Arr::get($searchParams, 'condition_id', '');
        $size = Arr::get($searchParams, 'size_id', '');
        $fromDate = Arr::get($searchParams, 'from_date', null);
        $toDate = Arr::get($searchParams, 'to_date', null);
        $itemInBound = Arr::get($searchParams, 'item_in_bound', []);
        $itemOutBound = Arr::get($searchParams, 'item_out_bound', []);
        $stockStatusId = Arr::get($searchParams, 'stock_status_id', null);
        $supplierId = Arr::get($searchParams, 'user_id', '');
        $dtColumns = Arr::get($searchParams, 'columns');
        $dtOrders = Arr::get($searchParams, 'order');

        $query = $this->model->query();

        if (!empty($itemInBound)) {
            $query->where('stock_out_type', null)->orWhere('stock_out_type', 0);
        }

        if (!empty($itemOutBound)) {
            $query->whereIn('stock_out_type', $itemOutBound);
        }

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('item', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%' . $keyword . '%');
                })
                    ->orWhere('sku', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('code', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($itemVariantId) {
            $query->where('item_variant_id', $itemVariantId);
        }

        if ($itemId) {
            $query->where('item_id', $itemId);
        }

        if ($brand) {
            $query->whereHas('item', function ($q) use ($brand) {
                $q->where('brand_id', $brand);
            });
        }

        if ($category) {
            $query->whereHas('item.categories', function ($query) use ($category) {
                $query->where('id', $category);
            });
        }

        if ($fromPrice > 0 && $toPrice === 0) {
            $query->where('price', $fromPrice);
        }

        if ($fromPrice === 0 && $toPrice > 0) {
            $query->where('price', $toPrice);
        }

        if ($fromPrice > 0 && $toPrice > 0) {
            $query->whereBetween('price', [$fromPrice, $toPrice]);
        }

        if ($condition) {
            $query->where('item_condition_id', $condition);
        }

        if ($size) {
            $query->where('size_id', $size);
        }

        if ($fromDate && $toDate === null) {
            $query->whereBetween('created_at', [$fromDate, Carbon::now()]);
        }

        if ($toDate && $fromDate === null) {
            $query->whereBetween('created_at', [Carbon::now(), $toDate]);
        }

        if ($fromDate && $toDate) {
            $toDate = Carbon::parse($toDate)->endOfDay();
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }

        if ($stockStatusId) {
            $query->where('stock_status_id', $stockStatusId);
        }

        $query->with([
            'item',
            'itemVariant'
        ]);

        if ($dtColumns && $dtOrders) {
            foreach ($dtOrders as $dtOrder) {
                $colIndex = $dtOrder['column'];
                $col = $dtColumns[$colIndex];
                if ($col['orderable'] === "true") {
                    $orderDirection = $dtOrder['dir'];
                    $orderName = $col['data'];
                    $query->orderBy($orderName, $orderDirection);
                }
            }
        }

        $query->latest();

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @inheritdoc
     */
    public function getItemStocks($itemIds)
    {
        return $this->model->whereIn('id', $itemIds)->get();
    }

    /**
     * @inheritdoc
     */
    public function getItemsBySize($item_id, $size_id, $color_id, $price, $quantity, $direction = 'asc', $itemsIDExclude = [], $itemVariantId)
    {

        $query = $this->model->where(['item_id' => $item_id, 'price' => $price, 'stock_status_id' => ItemStock::STOCK_IN_STOCK])
            ->whereRelation('itemVariant', 'id', '=', $itemVariantId)
            ->whereRelation('itemVariant', 'size_id', '=', $size_id)
            ->whereRelation('itemVariant', 'color_id', '=', $color_id);
        if (!empty($itemsIDExclude)) {
            $query->whereNotIn('id', $itemsIDExclude);
        }
        $query->orderBy('created_at', $direction)->limit($quantity);
        $details = $query->get();
        if (!empty($details)) {
            return $details;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getInStockItemStockByVariant($excludeId = null, $itemVariantId, $price)
    {
        $query = $this->model->query();

        $query->inStock();

        if ($excludeId) {
            $query->whereNot('id', $excludeId);
        }

        $query->where('item_variant_id', $itemVariantId)
            ->where('price', '<=', $price)
            ->oldest();

        return $query->first();
    }

    /**
     * @inheritDoc
     */
    public function getPartnersFromInStockVariants($itemVariantId)
    {
        return $this->model->inStock()->where('item_variant_id', $itemVariantId)->get();
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function find($id): Collection
    {
        return $this->model->find($id);
    }

    /**
     * @param $quote
     */
    public function updateStatusStock($quote)
    {
        $quoteDetails = $quote->quoteDetails;

        foreach ($quoteDetails as $detail) {
            $items = $this->model->whereIn('id', json_decode($detail->items))->get();

            foreach ($items as $item) {
                $item->update(['stock_status_id' => $this->model::STOCK_OUT_OF_STOCK]);
            }
        }
    }

    public function checkItemOutOfStock($quote)
    {
        $itemOutOfStock = [];
        foreach ($quote->quoteDetails as $detail) {
            $items = $this->model->with('item')->whereIn('id', json_decode($detail->items))->get();
            if ($items->where('stock_status_id', $this->model::STOCK_OUT_OF_STOCK)->count() > 0) {
                foreach ($items as $item) {
                    array_push($itemOutOfStock, 'Name: ' . $item->item->name . ' - SKU: ' . $item->sku);
                }
            }
        }

        return $itemOutOfStock;
    }

    /**
     * @inheritdoc
     */
    function getItemStock(array $params = [])
    {
        $result = $this->model->query();
        foreach ($params as $key => $value) {
            $result->where($key, $value);
        }
        return $result->get();
    }

    /**
     * @return mixed
     */
    public function getInboundItem()
    {
        return $this->model->where('stock_status_id', '!=', $this->model::STOCK_OUT_OF_STOCK)->orderBy('created_at', 'DESC')->get();
    }

    /**
     * @param $supplierId
     * @return mixed
     */
    // public function getSupplierItems($supplierId)
    // {
    //     return $this->model->where('supplier_id', '=', $supplierId)
    //         ->where('stock_status_id', '=', ItemStock::STOCK_RECEIVED)
    //         ->with('item')
    //         ->orderBy('created_at', 'DESC')
    //         ->get();
    // }

    /**
     * @param $itemStockId
     * @return mixed
     */
    public function updateStockIn($itemStockId)
    {
        $itemStock = $this->model->find($itemStockId);
        return $itemStock->update([
            'stock_status_id' => $this->model::STOCK_IN_STOCK,
            'stock_in_date' => \Carbon\Carbon::now()
        ]);
    }

    /**
     * @param $itemIds
     * @return mixed
     */
    public function getItemsStockList($itemIds)
    {
        return $this->model->whereIn('id', $itemIds)->get();
    }

    /**
     * @param $contractId
     * @return mixed
     */
    public function getTotalItemsInContract($contractId)
    {
        return $this->model->selectRaw('COUNT(*) AS total')
            ->whereIn('id', function ($query) use ($contractId) {
                $query->from('contract_items')->select('item_stock_id')
                    ->where('contract_id', $contractId);
            })->where('stock_status_id', '=', ItemStock::STOCK_IN_STOCK)->first();
    }

    /**
     * @inheritDoc
     *
     */
    public function getMaxInStockPrice()
    {
        return $this->model
            ->where('stock_status_id', CONST_STOCK_IN_STOCK)
            ->whereHas('itemVariant', function ($q) {
                $q->where('status', CONST_ENABLE);
            })
            ->max('price');
    }

    /**
     * @inheritDoc
     *
     */
    public function getMinInStockPrice()
    {
        return $this->model
            ->where('stock_status_id', CONST_STOCK_IN_STOCK)
            ->whereHas('itemVariant', function ($q) {
                $q->where('status', CONST_ENABLE);
            })
            ->min('price');
    }

    /**
     * @param $itemId
     * @return mixed
     */
    public function getLastTenSaleProduct($itemId)
    {
        return $this->model
            ->where('stock_status_id', $this->model::STOCK_OUT_OF_STOCK)
            ->where('stock_out_type', $this->model::STOCK_OUT_TYPE_SOLD)
            ->where('item_id', $itemId)
            ->whereNotNull('stock_out_date')
            ->orderBy('stock_out_date', 'DESC')
            ->take(self::LIMIT_STOCK)
            ->get();
    }

    /**
     * @param $variantId
     * @return mixed
     */
    public function getAvailableStockWithVariant($variantId)
    {
        return $this->model->where('item_variant_id', $variantId)
            ->where('stock_status_id', CONST_STOCK_IN_STOCK)
            ->orderBy('price', 'ASC')
            ->first();
    }
}
