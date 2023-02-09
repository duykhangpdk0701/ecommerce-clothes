<?php

namespace App\Repositories\OrderItem;

use App\Models\OrderItem;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * The repository for Role Model
 */
class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface
{
    const ITEM_PER_PAGE = 10;
    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * @inheritdoc
     */
    public function __construct(OrderItem $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return OrderItem::class;
    }

    /**
     * Generate slug
     *
     * @param string $name
     */
    function generateSlug($name)
    {
        $slug = Str::slug($name, '-');
        $checkSlug = $this->findBySlug($slug);
        while ($checkSlug) {
            $slug = $slug . '-1';
            $checkSlug = $this->findBySlug($slug);
        }
        return $slug;
    }

    /**
     * @param array $params
     * @return Builder[]|Collection
     */
    public function getOrderItem(array $params = [])
    {
        $qb = $this->model->query();
        foreach ($params as $k => $v) {
            $qb->where($k, $v);
        }
        return $qb->get();
    }

    /**
     * Count item in order
     * @param $orderId
     * @return mixed
     */
    public function countItemInOrder($orderId)
    {
        return $this->model->where('order_id', $orderId)->count();
    }

    /**
     * @param null $searchParams
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function serverOrderItemCancelPaginationFilteringFor($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $brand = Arr::get($searchParams, 'brand_id', '');
        $category = Arr::get($searchParams, 'item_category_id', '');
        $orderBy = Arr::get($searchParams, 'order_by', '');
        $fromPrice = Arr::get($searchParams, 'from_price', 0);
        $toPrice = Arr::get($searchParams, 'to_price', 0);
        $condition = Arr::get($searchParams, 'condition_id', '');
        $size = Arr::get($searchParams, 'size_id', '');
        $fromDate = Arr::get($searchParams, 'from_date', null);
        $toDate = Arr::get($searchParams, 'to_date', null);
        $branchId = Arr::get($searchParams, 'branch_id', null);
        $startDate = '';
        $endDate = '';

        $query = $this->model->query()->where('order_status_id', ORDER_STT_CANCELED);

        if ($fromDate) {
            $startDate = Carbon::parse($fromDate)->startOfDay();
        }

        if ($toDate) {
            $endDate = Carbon::parse($toDate)->endOfDay();
        }


        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(
                function ($q) use ($keyword) {
                    $q->whereHas(
                        'item',
                        function ($q) use ($keyword) {
                            $q->where('name', 'LIKE', '%' . $keyword . '%');
                        }
                    )->orWhere('sku', 'LIKE', '%' . $keyword . '%');
                }
            );
        }

        if ($brand) {
            $query->whereHas(
                'item',
                function ($q) use ($brand) {
                    $q->where('brand_id', $brand);
                }
            );
        }

        if ($category) {
            $query->whereHas(
                'item.categories',
                function ($query) use ($category) {
                    $query->where('id', $category);
                }
            );
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
            $query->whereHas(
                'itemVariant.condition',
                function ($query) use ($condition) {
                    $query->where('id', $condition);
                }
            );
        }

        if ($size) {
            $query->whereHas(
                'itemVariant.size',
                function ($query) use ($size) {
                    $query->where('id', $size);
                }
            );
        }

        if ($fromDate && $toDate === null) {
            $query->whereBetween('created_at', [$startDate, Carbon::now()]);
        }

        if ($toDate && $fromDate === null) {
            $query->whereBetween('created_at', [Carbon::now(), $endDate]);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if ($branchId) {
            $query->whereHas('order.branch', function ($query) use ($branchId) {
                $query->where('id', $branchId);
            });
        }

        $query->with(
            [
                'itemStock',
                'itemStock.contractItems',
                'itemStock.contractItems.contract',
                'supplier',
                'supplier.userProfile',
                'order',
                'itemStock',
                'item',
                'order',
                'order.staff',
                'variant',
                'variant.size.itemSizeLocale',
                'itemStock.contractItems.contract'
            ]
        );

        $query->orderByDesc('created_at');

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @param null $searchParams
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function serverOrderItemPaginationFilteringFor($searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $orderId = Arr::get($searchParams, 'order_id', '');
        $debtStatus = Arr::get($searchParams, 'debt_status', null);
        $orderStatusId = Arr::get($searchParams, 'order_status_id', null);
        $profitRate = Arr::get($searchParams, 'profit_rate', null);
        $supplier = Arr::get($searchParams, 'supplier', null);
        $fromDate = Arr::get($searchParams, 'from_date', null);
        $toDate = Arr::get($searchParams, 'to_date', null);
        $contractCode = Arr::get($searchParams, 'contract_id', null);
        $branchId = Arr::get($searchParams, 'branch_id', null);


        $query = $this->model->query();

        if ($debtStatus) {
            $query->where('debt_status', $debtStatus);
        }

        if ($orderStatusId) {
            $query->where('order_status_id', $orderStatusId);
        }

        if ($contractCode) {
            $query->whereHas(
                'itemStock.contractItems.contract',
                function ($query) use ($contractCode) {
                    $query->where('id', $contractCode);
                }
            );
        }

        if ($profitRate) {
            $query->where('profit_rate', '!=', $profitRate);
        }

        if ($orderId) {
            $query->where('order_id', $orderId);
        }

        if ($supplier) {
            $query->where('supplier_id', $supplier);
        }

        if ($fromDate && $toDate === null) {
            $query->whereBetween('created_at', [$fromDate, Carbon::now()]);
        }

        if ($toDate && $fromDate === null) {
            $query->whereBetween('created_at', [Carbon::now(), $toDate]);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }

        if ($branchId) {
            $query->whereHas('order.branch', function ($query) use ($branchId) {
                $query->where('id', $branchId);
            });
        }

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(
                function ($q) use ($keyword) {
                    $q->whereHas(
                        'item',
                        function ($q) use ($keyword) {
                            $q->where('name', 'LIKE', '%' . $keyword . '%');
                        }
                    )->orWhere('sku', 'LIKE', '%' . $keyword . '%')
                        ->orWhereHas('order', function ($q) use ($keyword) {
                            $q->where('order_code', 'LIKE', '%' . $keyword . '%');
                        });
                }
            );
        }

        $query->with(
            [
                'itemStock',
                'itemStock.contractItems',
                'itemStock.contractItems.contract',
                'supplier',
                'supplier.userProfile',
                'order',
                'itemStock',
                'item',
                'order',
                'order.staff',
                'variant',
                'variant.size.itemSizeLocale'
            ]
        );

        $query->orderByDesc('created_at');

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * Update order item info
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        try {
            DB::beginTransaction();

            $result = tap($model)->update($data);

            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getDueDebtItem($data = [])
    {
        $query = $this->model->with(
            [
                'itemStock',
                'itemStock.contractItems',
                'itemStock.contractItems.contract',
                'supplier',
                'supplier.userProfile',
                'order',
                'itemStock',
                'item',
                'order',
                'order.staff',
                'variant',
                'variant.size.itemSizeLocale'
            ]
        )->where('debt_status', CONST_STOCK_DEBT_DUE_DATE)
            ->where('order_status_id', ORDER_STT_COMPLETED)
            ->where('profit_rate', '!=', 0);

        if (count($data) > 0) {
            $fromdate = $data['from_date'] ?? '';
            $toDate = $data['to_date'] ?? '';
            $supplierId = $data['supplier_id'] ?? '';
            $brand = $data['brand_id'] ?? '';
            $contract = $data['contract_id'] ?? '';

            if ($fromdate && !$toDate) {
                $query->where('created_at', $fromdate);
            }

            if (!$fromdate && $toDate) {
                $query->whereBetween('created_at', [Carbon::now(), $toDate]);
            }

            if ($fromdate && $toDate) {
                $query->whereBetween('created_at', [$fromdate, $toDate]);
            }

            if ($supplierId) {
                $query->where('supplier_id', $supplierId);
            }

            if ($contract) {
                $query->whereHas(
                    'itemStock.contractItems.contract',
                    function ($query) use ($contract) {
                        $query->where('id', $contract);
                    }
                );
            }

            if ($brand) {
                ;
                $query->whereHas('order.branch', function ($query) use ($brand) {
                    $query->where('id', $brand);
                });
            }
        }

        return $query->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getItemStockDebtComplete($data)
    {
        $itemIds = $data['products'];
        $itemIds = explode(',', $itemIds);
        return $this->model->whereIn('item_stock_id', $itemIds)
            ->where('supplier_id', $data['supplier'])
            ->where('order_status_id', ORDER_STT_COMPLETED)
            ->get();
    }

    /**
     * Count orderItems canceled
     * @param $item_stock_ids
     * @param $orderId
     * @return mixed
     */
    public function countCancelOrderItems($item_stock_ids, $orderId)
    {
        return $this->model->whereIn('item_stock_id', $item_stock_ids)
            ->where('order_id', $orderId)
            ->where('order_status_id', ORDER_STT_CANCELED)
            ->count();
    }
}
