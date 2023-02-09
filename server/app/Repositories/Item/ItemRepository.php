<?php

namespace App\Repositories\Item;

use App\Models\Item;
use App\Models\ItemCondition;
use App\Models\ItemStock;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * The repository for Item Model
 */
class ItemRepository extends BaseRepository implements ItemRepositoryInterface
{
    /**
     * Paginate item per page
     */
    const ITEM_PER_PAGE = 10;

    const ORDER_TYPE_DESC = 'DESC';
    const ORDER_TYPE_ASC = 'ASC';

    const TRENDING_DAYS = 30;

    /**
     * Determine if the return items should include out of stock items
     *
     * @var boolean
     */
    public bool $showOutOfStockItems = false;

    /**
     * @inheritdoc
     */
    protected Model $model;

    /**
     * @inheritdoc
     */
    public function __construct(Item $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return Item::class;
    }

    /**
     * @inheritDoc
     */
    public function findWithVariants($id)
    {
        return $this->model->where('id', $id)
            ->with([
                'itemVariants' => function ($query) {
                    $query->withCount(['itemStocks' => function ($query) {
                        $query->where('stock_status_id', CONST_STOCK_IN_STOCK);
                    }]);
                },
                'itemVariants.size',
                'categories',
                'sizes'
            ])
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function findBySlug($slug, bool $withRelation = false): mixed
    {
        $query = $this->model->where('slug', $slug);

        if ($withRelation) {
            $query->with('brand')
                ->with('categories.parent')
                ->with('itemVariants', function ($query) {
                    $query->active();
                    $query->with(['itemStocks' => function ($query) {
                        $query->inStock()
                            ->oldest()
                            ->orderBy('price', 'asc');
                    }, 'size']);
                    $query->whereHas('itemStocks', function ($query) {
                        $query->inStock();
                    });
                });
        }

        return $query->first();
    }

    /**
     * @inheritDoc
     */
    public function serverPaginationFilteringFor($searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);

        $query = $this->itemFilter($searchParams);

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @inheritDoc
     */
    public function serverPaginationFilteringForApi($searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);

        $searchParams['stock_limit'] = CONST_STOCK_IN_STOCK;
        $searchParams['is_active'] = CONST_ENABLE;

        $query = $this->itemFilter($searchParams);

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @inheritDoc
     */
    public function itemFilter($searchParams)
    {
        $keyword = Arr::get($searchParams, 'search', '');
        $brandId = Arr::get($searchParams, 'brand_id', '');
        $brandIds = Arr::get($searchParams, 'brand_ids', '');
        $categoryId = Arr::get($searchParams, 'item_category_id', '');
        $sizeIds = Arr::get($searchParams, 'item_size_ids', '');
        $colorIds = Arr::get($searchParams, 'item_color_ids', '');
        $personTypeId = Arr::get($searchParams, 'item_person_type_id', '');
        $variantConditionId = Arr::get($searchParams, 'item_condition_id', '');
        $stockLimit = Arr::get($searchParams, 'stock_limit');
        $minPrice = Arr::get($searchParams, 'min_price');
        $maxPrice = Arr::get($searchParams, 'max_price');
        $isSale = Arr::get($searchParams, 'is_sale', CONST_DISABLE);
        $isActive = Arr::get($searchParams, 'is_active', '');
        $dtColumns = Arr::get($searchParams, 'columns');
        $dtOrders = Arr::get($searchParams, 'order');
        $orderBy = Arr::get($searchParams, 'order_by');

        $query = $this->model->query();

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('sku', 'LIKE', '%' . $keyword . '%');
            });
            $this->showOutOfStockItems = TRUE;
        }

        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        if ($brandIds) {
            if (is_string($brandIds)) {
                $brandIds = explode(',', $brandIds);
            }
            $query->whereIn('brand_id', $brandIds);
        }

        if ($personTypeId) {
            $query->where('item_person_type_id', $personTypeId);
        }

        if ($categoryId) {
            $query->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }

        if ($sizeIds) {
            if (is_string($sizeIds)) {
                $sizeIds = explode(',', $sizeIds);
            }
            $query->whereHas('sizes', function ($query) use ($sizeIds) {
                $query->whereIn('id', $sizeIds);
            });
        }

        if ($colorIds) {
            if (is_string($colorIds)) {
                $colorIds = explode(',', $colorIds);
            }
            $query->whereHas('colors', function ($query) use ($colorIds) {
                $query->whereIn('id', $colorIds);
            });
        }

        if ($variantConditionId || ($minPrice && $maxPrice) || $isSale) {
            $this->showOutOfStockItems = FALSE;
        }

        if ($isActive) {
            $query->active();
        }

        if ($stockLimit) {
            if (!$this->showOutOfStockItems) {
                $query->whereHas('stocks', function ($query) use ($stockLimit, $sizeIds, $variantConditionId, $minPrice, $maxPrice, $isSale) {
                    $this->queryStock($query, $stockLimit, $sizeIds, $isSale, $variantConditionId, $minPrice, $maxPrice);
                });
            }

            $query->with(['stocks' => function ($query) use ($sizeIds, $variantConditionId, $minPrice, $maxPrice, $isSale) {
                $this->queryStock($query, CONST_STOCK_IN_STOCK, $sizeIds, $isSale, $variantConditionId, $minPrice, $maxPrice);
            }]);
        }

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

        $this->orderItems($query, $orderBy);

        return $query;
    }

    /**
     * @inheritdoc
     */
    public function create($data): mixed
    {
        $data['slug'] = $this->generateSlug($data['name']);

        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        if (isset($data['name'])) {
            $data['slug'] = $this->generateSlug($data['name'], $model->id);
        }

        return $model->update($data);
    }

    /**
     * Generate slug
     *
     * @param string $name
     */
    function generateSlug($name, $id = null)
    {
        $slug = Str::slug($name, '-');
        $checkSlug = $this->checkSlugExist($slug, $id);
        while ($checkSlug) {
            $slug = $slug . '-1';
            $checkSlug = $this->checkSlugExist($slug, $id);
        }
        return $slug;
    }

    /**
     * Check if the slug is existed
     *
     * @param String $slug
     * @param Integer $id
     * @return void
     */
    public function checkSlugExist($slug, $id = null)
    {
        return $this->model->where('id', '!=', $id)->where('slug', $slug)->first();
    }

    /**
     * Query the stocks of the item with size
     *
     * @param query $query
     * @param int $stockStatusType
     * @param array $sizeIds
     * @return void
     */
    function queryStock($query, $stockStatusType, $sizeIds, $isSale, $variantConditionId = null, $minPrice = null, $maxPrice = null)
    {
        if ($stockStatusType) {
            $query->where('stock_status_id', $stockStatusType);
            //            if ($sizeIds) {
            //                $query->whereHas('itemVariant', function ($query) use ($sizeIds) {
            //                    $query->whereIn('size_id', $sizeIds);
            //                });
            //            }
            if ($variantConditionId) {
                $query->whereHas('itemVariant', function ($query) use ($variantConditionId) {
                    $query->where('item_condition_id', $variantConditionId);
                });
            }
            if ($minPrice && $maxPrice) {
                $query->where(function ($query) use ($minPrice, $maxPrice) {
                    $query->whereBetween('price', [$minPrice, $maxPrice]);
                });
            }
            if ($isSale) {
                $query->where('is_sale', CONST_ENABLE);
            }
            $query->whereHas('itemVariant', function ($query) {
                $query->where('status', CONST_ENABLE);
            });
            $query->orderBy('price', self::ORDER_TYPE_ASC);
        }
    }

    /**
     * Order the items
     *
     * @param Query $query
     * @param Integer $orderBy
     * @return void
     */
    function orderItems($query, $orderBy)
    {

        // switch ($orderBy) {
        //     case Item::ORDER_TRENDING:
        //         $now = Carbon::now();
        //         $query->withCount(['views' => function ($query) use ($now) {
        //             $query->where('created_at', '>', $now->subDays(self::TRENDING_DAYS));
        //         }]);
        //         $query->orderBy('views_count', self::ORDER_TYPE_DESC);
        //         break;
        //     case Item::ORDER_NEW:
        //         $query->withCount('views');
        //         $query->orderBy('created_at', self::ORDER_TYPE_DESC);
        //         break;
        //     case Item::ORDER_OLD:
        //         $query->withCount('views');
        //         $query->orderBy('created_at', self::ORDER_TYPE_ASC);
        //         break;
        //     case Item::ORDER_MOST_POPULAR:
        //         $query->withCount('views');
        //         $query->orderBy('views_count', self::ORDER_TYPE_DESC);
        //         break;
        //     case Item::ORDER_LATEST_LISTING:
        //         $query->withCount('views');
        //         $query->orderBy('updated_at', self::ORDER_TYPE_DESC);
        //         break;
        //     case Item::ORDER_FEATURED_ITEMS:
        //         $query->withCount('views');
        //         $query->where('is_featured', CONST_ENABLE)->orderBy('created_at', self::ORDER_TYPE_DESC);
        //         break;
        //     case Item::ORDER_PRICE_DESC:
        //         $query->orderByPrice();
        //         break;
        //     case Item::ORDER_PRICE_ASC:
        //         $query->orderByPrice(self::ORDER_TYPE_ASC);
        //         break;
        //     default:
        //         $query->withCount('views');
        //         $query->orderBy('created_at', self::ORDER_TYPE_DESC);
        //         break;
        // }
    }
}
