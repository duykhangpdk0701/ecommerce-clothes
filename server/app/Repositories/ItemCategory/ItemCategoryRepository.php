<?php

namespace App\Repositories\ItemCategory;

use App\Models\ItemCategory;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * The repository for Item Category Model
 */
class ItemCategoryRepository extends BaseRepository implements ItemCategoryRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    const ORDER_TYPE_DESC = 'DESC';
    const ORDER_TYPE_ASC = 'ASC';
    const DEFAULT_ORDER_BY = 'order';
    const PER_PAGE = 100;
    const ITEM_PER_CATEGORY = 10;

    /**
     * @inheritdoc
     */
    public function __construct(ItemCategory $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return ItemCategory::class;
    }

    /**
     * @inheritDoc
     */
    public function serverFilterFor($searchParams)
    {
        $withChildren = Arr::get($searchParams, 'with_children', false);
        $withItem = Arr::get($searchParams, 'with_item', false);
        $isShow = Arr::get($searchParams, 'is_show', true);
        $orderBy = Arr::get($searchParams, 'order_by', self::DEFAULT_ORDER_BY);
        $orderType = Arr::get($searchParams, 'order_type', self::ORDER_TYPE_DESC);

        $query = $this->model->query();

        $query->whereNull('parent_id');

        if ($withChildren) {
            $query->with('children');
        }

        if ($isShow) {
            $query->where('status', CONST_ENABLE);
        }

        if ($withItem) {
            $query->whereHas('items', function ($query) {
                $query->active();
                $query->whereHas('stocks', function ($query) {
                    $this->queryStocks($query);
                });
            });

            $categories = $query->get();

            foreach ($categories as $key => $category) {
                $category->load(['items' => function ($query) {
                    $query->whereHas('stocks', function ($query) {
                        $this->queryStocks($query);
                    });
                    $query->with('stocks', function ($query) {
                        $this->queryStocks($query);
                    });
                    $query->withCount('views')->orderBy('views_count', self::ORDER_TYPE_DESC);
                    $query->limit(10);
                    $query->get();
                }]);
            }
            return $categories;
        }

        $query->orderBy($orderBy, $orderType);
        return $query->get();
    }


    /**
     * @inheritDoc
     */
    public function serverPaginationFilterFor($searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');

        $query = $this->model->query();
        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        return $query->paginate(Arr::get($searchParams, 'per_page', $limit));
    }


    /**
     * @inheritDoc
     */
    public function serverPaginationFilterForApi($searchParams): LengthAwarePaginator
    {
        $withChildren = Arr::get($searchParams, 'with_children', false);
        $isShow = Arr::get($searchParams, 'is_show', true);
        $orderBy = Arr::get($searchParams, 'order_by', self::DEFAULT_ORDER_BY);
        $orderType = Arr::get($searchParams, 'order_type', self::ORDER_TYPE_DESC);
        $limit = Arr::get($searchParams, 'limit', self::PER_PAGE);

        $query = $this->model->query();

        $query->whereNull('parent_id');

        if ($withChildren) {
            $query->with('children');
        }

        if ($isShow) {
            $query->where('status', CONST_ENABLE);
        }

        $query->orderBy($orderBy, $orderType);

        return $query->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function allParentWithChildren()
    {
        return $this->model->whereNull('parent_id')->with('children')->get();
    }

    /**
     * @inheritdoc
     */
    public function allParents()
    {
        return $this->model->whereNull('parent_id')->get();
    }

    /**
     * @inheritdoc
     */
    public function create($data): mixed
    {
        $data['slug'] = $this->generateSlug($data['name']['en']);

        $this->resetCache();

        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data): mixed
    {
        $data['slug'] = $this->generateSlug($data['name']['en'], $model->id);

        $this->resetCache();

        return $model->update($data);
    }

    /**
     * @inheritdoc
     */
    public function toggleStatus($model)
    {
        $itemCategory = $model->update(['status' => !$model->status]);

        $this->resetCache();

        return $itemCategory;
    }

    /**
     * @inheritdoc
     */
    public function destroy($model): bool
    {
        if ($model->items->count() || $model->sizes->count()) {
            session()->flash(NOTIFICATION_ERROR, __('error.item_category.delete', ['name' => 'items and sizes']));
            return $model;
        } else if ($model->children()->count()) {
            session()->flash(NOTIFICATION_ERROR, __('error.item_category.delete', ['name' => 'children']));
            return $model;
        }
        $model->delete();

        $this->resetCache();

        return session()->flash(NOTIFICATION_SUCCESS, __('success.delete', ['resource' => $model->name]));
    }

    /**
     * Check slug exists
     */
    function checkSlugExist($slug, $id = null)
    {
        return $this->model->where('id', '!=', $id)->where('slug', $slug)->first();
    }

    /**
     * Generate slug
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

    function queryStocks($query)
    {
        $query->where('stock_status_id', CONST_STOCK_IN_STOCK);
        $query->whereHas('itemVariant', function ($query) {
            $query->where('status', CONST_ENABLE);
        });
    }

    /**
     * Reset all the caches store for this resource
     *
     * @return void
     */
    function resetCache()
    {
        Cache::forget(ItemCategory::CACHE_SUB_NAVBAR);
    }
}
