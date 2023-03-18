<?php

namespace App\Repositories\ItemSize;

use App\Models\ItemSize;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * The repository for Item Size Model
 */
class ItemSizeRepository extends BaseRepository implements ItemSizeRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected Model $model;

    const PER_PAGE = 100;
    const ORDER_TYPE_DESC = 'DESC';

    /**
     * @inheritdoc
     */
    public function __construct(ItemSize $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return ItemSize::class;
    }

    /**
     * @inheritDoc
     */
    public function create($data): mixed
    {
        return $this->model->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($model, $data): mixed
    {
        return $model->update($data);
    }

    /**
     * @inheritDoc
     */
    public function serverFilteringFor($searchParams)
    {
        $keyword = Arr::get($searchParams, 'search', '');
        $categoryId = Arr::get($searchParams, 'item_category_id', '');
        $personTypeId = Arr::get($searchParams, 'item_person_type_id', '');
        $limit = Arr::get($searchParams, 'limit', self::PER_PAGE);
        $isPaginated = Arr::get($searchParams, 'is_paginated', FALSE);
        $orderBy = Arr::get($searchParams, 'order_by', '');

        $query = $this->model->query();

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->where('value', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($categoryId) {
            $query->where('item_category_id', $categoryId);
        }

        if ($personTypeId) {
            $query->where('item_person_type_id', $personTypeId);
        }

//        if ($isPaginated) {
            $query->paginate(Arr::get($searchParams, 'per_page', $limit));
//        }

        return $query->with(['itemCategory', 'itemPersonType'])->get();
    }

    /**
     * @inheritDoc
     */
    public function serverPaginationFilterForApi($searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', self::PER_PAGE);
        $categoryId = Arr::get($searchParams, 'item_category_id', '');
        $personTypeId = Arr::get($searchParams, 'item_person_type_id', '');

        $query = $this->model->query();

        if ($categoryId) {
            $query->where('item_category_id', $categoryId);
        }

        if ($personTypeId) {
            $query->where('item_person_type_id', $personTypeId);
        }

        $query->orderBy('order', self::ORDER_TYPE_DESC);

        return $query->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function all(): Collection
    {
        return $this->model->with(['itemCategory', 'itemPersonType'])->get();
    }

    /**
     * @inheritdoc
     */
    public function destroy($model): bool
    {
        if ($model->itemVariants->count()) {
            session()->flash(NOTIFICATION_ERROR, __('error.item_size.delete', ['name' => 'item variants']));
            return $model;
        }
        $model->delete();
        return session()->flash(NOTIFICATION_SUCCESS, __('success.delete', ['resource' => $model->name]));
    }
}
