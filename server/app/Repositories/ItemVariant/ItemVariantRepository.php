<?php

namespace App\Repositories\ItemVariant;

use App\Models\ItemVariant;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * The repository for Item Variant Model
 */
class ItemVariantRepository extends BaseRepository implements ItemVariantRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * Paginate item per page
     */
    const ITEM_PER_PAGE = 500;

    /**
     * @inheritdoc
     */
    public function __construct(ItemVariant $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return ItemVariant::class;
    }

    /**
     * @inheritDoc
     */
    public function serverFilteringFor($searchParams)
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $excludeIds = Arr::get($searchParams, 'exclude_ids', '');
        $itemId = Arr::get($searchParams, 'item_id', '');
        $sizeId = Arr::get($searchParams, 'size_id', '');
        $colorId = Arr::get($searchParams, 'color_id', '');
        $isShow = Arr::get($searchParams, 'is_show', '');
        $stockStatus = Arr::get($searchParams, 'item_stock_status', '');
        $stockLimit = Arr::get($searchParams, 'stock_limit');
        $orderBy = Arr::get($searchParams, 'order_by', '');

        $query = $this->model->query();

        if ($itemId) {
            $query->where('item_id', $itemId);
        }

        if ($sizeId) {
            $query->where('size_id', $sizeId);
        }

        if ($colorId) {
            $query->where('color_id', $colorId);
        }

        if ($isShow == CONST_DISABLE || $isShow) {
            $query->where('status', $isShow);
        }

        if ($excludeIds) {
            $query->whereNotIn('id', $excludeIds);
        }

        if ($stockStatus) {
            $query->with(['itemStocks' => function ($query) use ($stockStatus) {
                $query->where('stock_status_id', $stockStatus);
            }]);

            $query->withCount(['itemStocks' => function ($query) use ($stockStatus) {
                $query->where('stock_status_id', $stockStatus);
            }]);
        }

        $itemVariants = $query->get();

        return $itemVariants;
    }

    /**
     * @inheritDoc
     */
    public function findByIdWithInStocks(int $id)
    {
        return $this->model->where('id', $id)->with(['itemStocks' => function ($query) {
            $query->where('stock_status_id', CONST_STOCK_IN_STOCK);
            $query->orderBy('price', 'ASC');
            $query->orderBy('created_at', 'DESC');
        }])
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function findByIdWithLowestInStock(int $id)
    {
        return $this->model->where('id', $id)
            ->with(['lowestInStockItemStock', 'item', 'size'])
            ->first();
    }

    /**
     * @inheritdoc
     */
    public function toggleStatus($model)
    {
        return $this->update($model, ['status' => !$model->status]);
    }

    public function findByItemId(int $id){
        return $this->model->where('item_id', $id)->get();
    }
}
